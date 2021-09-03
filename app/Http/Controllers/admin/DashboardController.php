<?php

namespace App\Http\Controllers\admin;

use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Controllers\Controller;
use App\Models\Connections;
use App\Models\User;
use App\Models\Parametr;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function connections($show=0,$sort=0)
    {
        $items=['Connections','Community'];
        $lines=['20 items','50 items','100 items'];
        $sortname=['By id','By connects','By date'];
        $ips = Connections::get();
        $ipsunique = $ips->unique('visitor');
        $ipsunique->values()->all();
        $data = collect();
        $counts = 0;
        foreach ($ipsunique as $ipunique)
        {
            $count = $ips->where('visitor',$ipunique->visitor)->count();
            $ipunique['counts'] = $count;
            $data = $data->push($ipunique);
            $counts += $count;
        }
        //dd(__METHOD__,$counts);
        $perPage=20;
        switch ($show)
        {
            case 1:{$perPage=50;break;}
            case 2:{$perPage=100;break;}
        }
        switch($sort)
        {
            case 0:
            {
                $data = $data->sortBy('id');
                break;
            }
            case 1:
            {
                $data = $data->sortByDesc('counts');
                break;
            }
            case 2:
            {
                $data = $data->sortByDesc('updated_at');
                break;
            }
        }
        $data = $data->toArray();
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = array_slice($data, $perPage * ($currentPage - 1), $perPage);
        //with path of current page
        $data = (new LengthAwarePaginator($currentItems, count($data ), $perPage, $currentPage))->setPath(route('admin.connections',['show'=>$show,'sort'=>$sort]));
        //Convert array of array to array of object
        $data->each(function ($item, $itemKey) use($data) {
            $data[$itemKey] = (Object)$item;
        });
        return view('admin.connections')
            ->with('sort',$sort)
            ->with('sortname',$sortname)
            ->with('show',$show)
            ->with('lines',$lines)
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
                    $user['status']=$parametr->status;
                    $user['smessage']=$parametr->smessage;
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
