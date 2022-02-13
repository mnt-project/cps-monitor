<?php

namespace App\cps;
use App\Models\Group;
use Illuminate\Support\Facades\Auth;

class Groups
{
    public $group;
    public function __construct($groupid=0,$sortid=0,$create=false)
    {
        if($create)
        {
            $this->group = new Group();
        }
        else
        {
            if($groupid>0)
            {
                $this->group = Group::with(['post','follow','user'])->findOrFail($groupid);
            }
            else
            {
                $this->group = Group::with(['post','follow','user'])->get();
            }
        }
    }

    /**
     * @return Group|Group[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function getGroup()
    {
        return $this->group;
    }
    public function getGroupFollows()
    {
        return $this->group->follow;
    }
    public function getGroupPosts()
    {
        return $this->group->post;
    }
    public function getGroupAlbum()
    {
        return $this->group->album->sortByDesc('updated_at')->take(5);
    }
    public function isGroupOpen()
    {
        return $this->group->open;
    }
    public function createGroup(Group $creategroup)
    {
        if(Auth::check())
        {
            $creategroup->user_id=Auth::id();
        }
        else
        {
            $creategroup->user_id=0;
        }
        //dd(__METHOD__,$creategroup->toArray());
        $this->group = Group::create($creategroup->toArray());
        $this->group->save();
        return $this->group;
    }
}












