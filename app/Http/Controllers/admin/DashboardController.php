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
        $ipsunique = $ips->unique('visitor');
        $ipsunique->values()->all();
        $data = collect();
        $counts = [];
        foreach ($ipsunique as $ipunique)
        {
            $data = $data->push($ipunique);
            $counts[] = $ips->where('visitor',$ipunique->visitor)->count();
        }

        //dd(__METHOD__,$data);
        return view('admin.connections')
            ->with('ips',$data)
            ->with('counts',$counts)
            ->with('items',$items);
    }
    public function community()
    {
        $items=['Connections','Community'];
        return view('admin.community')
            ->with('items',$items);
    }
}
