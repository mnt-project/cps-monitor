<?php


namespace App\cps;


use App\Models\User;

class Users
{
    protected $user;

    /**
     * Users constructor.
     * @param $user
     */
    public function __construct($user)
    {
        $this->user = User::findOrFail($user);
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user->uparametr;
    }

}
