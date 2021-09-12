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
    public function connections($sort=0,$method='asc',$show=0)
    {
        $items = ['Connections', 'Community', 'Groups'];
        $lines = ['20 items', '50 items', '100 items'];
        $sortname = ['By id', 'By connects', 'By date'];
        $perPage=20;
        switch ($show)
        {
            case 1:{$perPage=50;break;}
            case 2:{$perPage=100;break;}
        }
        switch ($sort)
        {
            case 0:{$order='id';break;}
            case 1:{$order='visits';break;}
            case 2:{$order='updated_at';break;}
        }
        $ips = Connections::orderBy($order, $method)->paginate($perPage);
        //dd(__METHOD__,$ips);
        return view('admin.connections')
            ->with('sort',$sort)
            ->with('sortname',$sortname)
            ->with('show',$show)
            ->with('lines',$lines)
            ->with('ips',$ips)
            ->with('method',$method)
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
