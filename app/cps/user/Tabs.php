<?php


namespace App\cps\user;


use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Tabs
{
    protected $tab;
    /**
     * Tabs constructor.
     * @param $tab
     */
    public function __construct($value=0,$titel='Default',$type='default.index',$route='tab.index',$create=false)
    {
        if(Auth::check())
        {
            if($create)
            {
                $tabid=0;
                do{//Проверка свободного слота в базе
                    if($tabid<4)$tabid++;
                    else {$tabid=0;break;}
                } while (\App\Models\Tabs::where("tabid", "=", $tabid)->first() instanceof \App\Models\Tabs);
                if($tabid)
                {
                    $this->tab = \App\Models\Tabs::create([
                        'user_id' => Auth::id(),
                        'tabid' => $tabid,
                        'titel' => $titel,
                        'type' => $type,
                        'value' => $value,
                        'route' => $route,
                        'life' => 1,
                        'visible' => 1
                    ]);
                }
                else
                {
                    $this->tab = $this->defaultTab();
                }
            }
            else
            {
                $tabs = \App\Models\Tabs::where('user_id', Auth::id())->get();
                //dd(__METHOD__,$tabs);
                if(is_null($tabs))
                {
                    $tabs = $this->defaultTab();
                }
                $this->tab = $tabs;
            }
        }
        else
        {
            $this->tab = $this->defaultTab();
        }
    }
    protected function defaultTab()
    {
        return new \App\Models\Tabs([
            'user_id' => Auth::id(),
            'tabid' => 0,
            'titel' => 'Default',
            'type' => 'default.index',
            'value' => 0,
            'route' => 'tab.index',
            'life' => 1,
            'visible' => 1
        ]);
    }
    /**
     * @return mixed
     */
    public function getTab()
    {
        return $this->tab;
    }

    /**
     * @return User|User[]|\Illuminate\Contracts\Auth\Authenticatable|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */

}
