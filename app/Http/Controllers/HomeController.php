<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Group;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;

class HomeController extends Controller
{
    //
    public function index()
    {
        $users = User::get();
        $groups = Group::get();
        $blogs = Blog::get();
        $blogs->load('user');
       //dd(__METHOD__,$blogs);
        $usersOnline = collect();
        $groupsPublic = collect();
        foreach ($users as $user)
        {
            if($user->isOnline())
            {
                $usersOnline->push($user);
            }
        }
        foreach ($groups as $group)
        {
            if($group->public and $group->open)
            {
                $groupsPublic->push($group);
            }
        }
        Log::channel('connections')->info('[IP:] Guest income | Last connect: ');
        return view('home')
            ->with('blogs',$blogs)
            ->with('usersOnline',$usersOnline)
            ->with('groupsPublic',$groupsPublic);
    }
}
