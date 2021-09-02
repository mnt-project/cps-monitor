<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Connections;
use App\Models\User;
use App\Models\Parametr;
use Carbon\Carbon;
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
    public function community($sort=0,$view=0)
    {
        $items=['Connections','Community'];
        $names=['All users','Muted users','Banned users','Last connected users','Last register users'];
        $viewnames=['Thumbnail','Table','Cards'];
        //$users = User::with(['uparametr','avatar'])->get();
        $users=collect();
        switch ($sort)
        {
            case 0:
            {
                $users = User::where('id','>',0)->with(['parametr','avatar'])->get();
                break;
            }
            case 1:
            {
                $parametrs = Parametr::with(['user','avatar'])->get();
                foreach ($parametrs as $parametr)
                {
                    //$user=$parametr->user;
                    if($parametr->muted)
                    {
                        $user=$parametr->user;
                        $user->avatar = $parametr->avatar;
                        $users->push($user);
                    }

                }
                //dd($users->parametr->user_id);
                break;
            }
            case 2:
            {
                $parametrs = Parametr::with(['user','avatar'])->get();
                foreach ($parametrs as $parametr)
                {
                    //$user=$parametr->user;
                    if($parametr->banned)
                    {
                        $user=$parametr->user;
                        $user->avatar = $parametr->avatar;
                        $users->push($user);
                    }

                }
                break;
            }
            case 3:
            {
                $parametrs = Parametr::where('id','>',0)->with(['user', 'avatar'])->get()->sortByDesc('connected_at');
                foreach ($parametrs as $parametr)
                {
                    $user=$parametr->user;
                    $user->avatar = $parametr->avatar;
                    $users->push($user);

                }
                break;
            }
            case 4:
            {
                $users = User::where('id','>',0)->with(['parametr','avatar'])->get()->sortByDesc('created_at');
                break;
            }
        }
        //$user = $users->find(17);
        return view('admin.community')
            ->with('view',$view)
            ->with('sort',$sort)
            ->with('names',$names)
            ->with('viewnames',$viewnames)
            ->with('users',$users)
            ->with('items',$items);
    }
}
