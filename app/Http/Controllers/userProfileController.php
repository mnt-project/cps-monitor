<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class userProfileController extends Controller
{
    //
    public function userGetInfo($id)
    {
        $user = Auth::user($id);
        return view('profile',['data' => $user]);
    }
}
