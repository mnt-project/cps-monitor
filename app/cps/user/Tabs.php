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
                } while (session()->has('tab'.$tabid));
                if($tabid)
                {
                    $this->tab = [
                        'tabid' => $tabid,
                        'titel' => $titel,
                        'type' => $type,
                        'value' => $value,
                        'route' => $route,
                    ];
                    session(['tab'.$tabid=>$this->tab]);
                    session()->put('tabid',$tabid);
                }
                else
                {
                    $this->tab = $this->defaultTab();
                }
            }
            else
            {
                $tabs = collect();
                for($t=1;$t<5;$t++)
                {
                    $stab=session('tab'.$t);
                    if($stab)
                    {
                        $tabs = $tabs->push($stab);
                    }
                }
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
        return $this->tab=[
            'tabid' => 0,
            'titel' => 'Default',
            'type' => 'default.index',
            'value' => 0,
            'route' => 'tab.index',
        ];
    }
    public static function deleteTabs()
    {
        for($t=1;$t<6;$t++)
        {
            if(session()->has('tab'.$t))session()->forget('tab'.$t);
        }
        if(session()->has('tabid'))session()->forget('tabid');
    }
    /**
     * @return mixed
     */
    public function getTab()
    {
        return $this->tab;
    }
    public static function getUser($value)
    {
        if($value)
        {
            $user=User::findOrFail($value);
            //dd(__METHOD__,$user);
            return $user;
        }
    }

    /**
     * @return User|User[]|\Illuminate\Contracts\Auth\Authenticatable|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */

}
