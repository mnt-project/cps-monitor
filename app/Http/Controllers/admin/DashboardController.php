<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Connections;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function connections()
    {
        $items=['Connections','Community'];
        $ips = Connections::get();
        $ips = $ips->unique('visitor');
        $ips->values()->all();
        //dd(__METHOD__,$ips);
        return view('admin.connections')
            ->with('ips',$ips)
            ->with('items',$items);
    }
    public function community()
    {
        $items=['Connections','Community'];
        return view('admin.community')
            ->with('items',$items);
    }
}
