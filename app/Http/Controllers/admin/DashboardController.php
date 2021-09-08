<?php

namespace App\Http\Controllers\admin;

use App\cps\Groups;
use App\Models\Group;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Controllers\Controller;
use App\Models\Connections;
use App\Models\User;
use App\Models\Settings;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function connections($show=0,$sort=0)
    {
        $items=['Connections','Community','Groups'];
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
        $items=['Connections','Community','Groups'];
        $names=['All users','Muted users','Banned users','Last connected users','Last register users','Config error'];
        $viewnames=['Thumbnail','Table','Cards'];
        //$users = User::with(['uparametr','avatar'])->get();
        $sorted=collect();
        switch ($sort)
        {
            case 0://All users
            {
                $sorted = User::where('id','>',0)->with(['settings','avatar'])->get();
                break;
            }
            case 1://Muted users
            {
                $users = User::where('id','>',0)->with(['settings','avatar'])->get();
                foreach ($users as $user)
                {
                    if($user->settings->muted)
                    {
                        $sorted->push($user);
                    }
                }
                break;
            }
            case 2://Banned users
            {
                $users = User::where('id','>',0)->with(['settings','avatar'])->get();
                foreach ($users as $user)
                {
                    if($user->settings->banned)
                    {
                        $sorted->push($user);
                    }
                }
                break;
            }
            case 3://Last connected users
            {
                $settings = Settings::where('id','>',0)->with(['user', 'avatar'])->get()->sortByDesc('connected_at');
                foreach ($settings as $parametr)
                {
                    $user=$parametr->user;
                    $user['status']=$parametr->status;
                    $user['smessage']=$parametr->smessage;
                    $user->avatar = $parametr->avatar;
                    $sorted->push($user);

                }
                break;
            }
            case 4://Last register users
            {
                $sorted = User::latest()->with(['settings','avatar'])->get();
                break;
            }
            case 5://Config error
            {
                $users = User::where('id','>',0)->with(['settings','avatar'])->get();
                foreach ($users as $user)
                {
                    if($user->settings->status)
                    {
                        $sorted->push($user);
                    }
                }
                break;
            }
        }
        return view('admin.community')
            ->with('view',$view)
            ->with('sort',$sort)
            ->with('names',$names)
            ->with('viewnames',$viewnames)
            ->with('users',$sorted)
            ->with('items',$items);
    }
    public function userEdit(User $user)
    {
        $user->load('settings','avatar','posts','follow','groups');
        $groups = Group::get();
        $subscribes = collect();
        $follows =$user->follow;
        //dd(__METHOD__,$follows);
        foreach ($follows as $follow)
        {
            $subscribes = $subscribes->push($groups->find($follow->group_id));
        }
        return view('admin.user')
            ->with('groups', $subscribes)
            ->with('user',$user);
    }
    public function groups($sort=0,$view=0)
    {

        $items = ['Connections', 'Community', 'Groups'];
        $group = new Groups(1);
        $text='test';
        return view('admin.group')
            ->with('text',$text)
            ->with('group',$group->getGroup());
    }
}
