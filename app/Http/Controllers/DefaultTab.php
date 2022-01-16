<?php

namespace App\Http\Controllers;

use App\cps\user\Tabs;
use Illuminate\Http\Request;

class DefaultTab extends Controller
{
    public function index($tabid=0)
    {
        session()->put('tabid',$tabid);
        return redirect()->back();
        //dd(__METHOD__,$tabid);
        //
    }
    public function create($value,$titel,$type,$route)
    {
        new Tabs($value,$titel,$type,$route,true);
        return redirect()->back();
    }
    public function close($tabid)
    {
        session()->forget('tab'.$tabid);
        return redirect()->back();
    }
}
