<?php


namespace App\cps;
use App\Models\Group;

class Groups
{
    protected $group;
    public function __construct($groupid)
    {
        $this->group = Group::with(['post','follow','user'])->findOrFail($groupid);
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

}












