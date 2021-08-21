<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SwitchButtom extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $flag;
    public $route;
    public $labeltrue,$labelfalse;
    public function __construct($flag=false,$route='#',$labeltrue='ON',$labelfalse='OFF')
    {
        //
        $this->flag=$flag;
        $this->route=$route;
        $this->labeltrue=$labeltrue;
        $this->labelfalse=$labelfalse;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.switch-buttom');
    }
}
