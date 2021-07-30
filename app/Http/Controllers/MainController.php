<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;


class MainController extends Controller
{

    public function index()
    {
        if(Auth::check())
        {

        }return redirect(route('user.login'))->withErrors('Ошибка авторизации!');
    }
    public function set_language($lang)
    {
        //
        if(in_array($lang, ['en', 'ru']))
        {
            //dd(__METHOD__,$lang);
            App::setLocale($lang);
            return redirect(route('group.list'));
        }
    }
    //
}
