<?php

namespace App\cps;
use App\Models\Group;
use Illuminate\Support\Facades\Auth;

class Groups
{
    protected $group;
    public function __construct($groupid,$create=false)
    {
        if($create)
        {
            $this->group = new Group();
        }
        else
        {
            $this->group = Group::with(['post','follow','user'])->findOrFail($groupid);
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












