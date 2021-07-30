<?php

namespace App\View\Components;

use App\Models\Group;
use Illuminate\View\Component;

class GroupFormModal extends Component
{
    public $user;
    public $actionID;
    public $group;
    public $group_data;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($user,$actionID,$group=0)
    {
        //
        $this->user=$user;
        $this->actionID=$actionID;
        $this->group=$group;

        //dd(__METHOD__,$group);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.group-form-modal');
    }
    public function action($actionID)
    {
        $destination=['Create','Edit'];
        return $destination[$actionID];
    }
    public function group_name($group)
    {
        $group_data = Group::find($group);
        return $group_data;
    }
}
