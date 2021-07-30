<?php

namespace App\View\Components;

use Illuminate\View\Component;

class loginForm extends Component
{
    public $pStatus;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($pStatus)
    {
        $this->pStatus=$pStatus;
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.login-form');
    }
}
