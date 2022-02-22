<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SortBar extends Component
{
    public $argname;
    public $value;
    public $sort;
    public $show;
    public $method;
    public $sortname;
    public $lines;
    public $route;

    /**
     * Create a new component instance.
     *
     * @param $route
     * @param $argname
     * @param $value
     * @param $show
     * @param $method
     * @param $sortname
     * @param $lines
     */
    public function __construct($route,$argname,$value,$sort,$show,$method,$sortname,$lines)
    {
        //
        $this->argname = $argname;
        $this->value = $value;
        $this->sort = $sort;
        $this->show = $show;
        $this->method = $method;
        $this->sortname = $sortname;
        $this->lines = $lines;
        $this->route = $route;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.sort-bar');
    }
}
