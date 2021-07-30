<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class loginButton extends Component
{
    public $status;
    public $name;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($status)
    {
        $this->status=$status;
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.login-button');
    }
    public function icon_type($status)
    {
        switch($status)
        {
            case false: return 'bi-person-square';
            case true: return 'bi-box-arrow-in-right';
            default: return 'bi-hourglass-split';
        }
    }
    public function get_button_name($status)
    {
        $user = Auth::user();
        if($user)
        {
            $user = $user->login;
        }
        else
        {
            $user = 'Guest';
        }
        switch($status)
        {
            case false: return 'Login';
            case true: return $user;
            default: return 'Error';
        }
    }
    public function get_route($status)
    {
        switch($status)
        {
            case false: return 'user.login';
            case true: return 'user.logout';
            default: return 'user.logout';
        }
    }
}
