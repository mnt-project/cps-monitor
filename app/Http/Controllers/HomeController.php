<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    //
    public function index()
    {
        $users = User::get();
        $groups = Group::get();
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
        Log::channel('connections')->info('[IP:'.\Request::ip().'] Guest income at '.Carbon::now());
        return view('home')
            ->with('usersOnline',$usersOnline)
            ->with('groupsPublic',$groupsPublic);
    }
}
