<?php

namespace App\Http\Controllers\admin;

use App\cps\admin\Connect;
use App\cps\Groups;
use App\cps\user\Tabs;
use App\Models\Address;
use App\Models\Group;
use App\Models\JournalConnections;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Controllers\Controller;
use App\Models\Connections;
use App\Models\User;
use App\Models\Settings;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $items = ['Connections', 'Community', 'Groups','Journal'];
    public function connections(Request $request,$sort=0,$method='asc',$show=0,$connect=0)
    {
        $userip = $request->ip();
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
        $ips = Connections::with('address')->orderBy($order, $method)->paginate($perPage);
        if($connect>0)
        {
            $ipinfo=Connections::findOrFail($connect);
            $ipinfo->load('address');
            //dd(__METHOD__,$ipinfo);
        }
        else
        {
            $ipinfo=(new Connect($userip))->getIp();
        }
        //dd(__METHOD__,$ips);
        return view('admin.connections')
            ->with('sort',$sort)
            ->with('sortname',$sortname)
            ->with('show',$show)
            ->with('lines',$lines)
            ->with('ips',$ips)
            ->with('connect',$connect)
            ->with('ipinfo',$ipinfo)
            ->with('method',$method)
            ->with('items',$this->items);
    }
    public function journalList($sort=0,$method='asc',$show=0)
    {
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
        $ips = JournalConnections::with('address')->orderBy($order, $method)->paginate($perPage);

        //dd(__METHOD__,$ips);
        return view('admin.journal')
            ->with('sort',$sort)
            ->with('sortname',$sortname)
            ->with('show',$show)
            ->with('lines',$lines)
            ->with('ips',$ips)
            ->with('method',$method)
            ->with('items',$this->items);
    }
    public function address_info($id)
    {
        $ip=Connections::findOrFail($id);
        dd(__METHOD__,$ip);

    }
    public function address_add(Request $request,$id)
    {
        $ip = Connections::findOrFail($id);
        $address = Address::where('ipaddress',$ip->visitor)->get();
        if(!empty($address))
        {
            //dd(__METHOD__,$address);
            Address::create([
                'ipaddress'=>$ip->visitor,
                'titel'=>$request->get('titel'),
                'note'=>$request->get('note'),
            ]);
            session()->flash('success','IP:['.$ip->visitor.'] addeded in address book!');
        }
        return redirect()->back();
    }
    public function community($sort=0,$view=0)
    {
        $names=['All users','Muted users','Banned users','Last connected users','Last register users','Config error'];
        $viewnames=['Thumbnail','Table','Cards'];
        $sorted=collect();
        $tabid=session('tabid');
        $tabs=(new Tabs())->getTab();
        $tabscount=$tabs->count();
        if($tabid>0)
        {
            if($tabscount>0)
            {
                foreach ($tabs as $key=>$tab)
                {
                    if($tabid != $tab['tabid'])
                    {
                        if($key == $tabscount-1)
                        {
                            $tabid = $tab['tabid'];
                            //dump('tabid_app',$tabid);
                        }
                    }else break;
                }
            }else $tabid = 0;
        }
        session()->put('tabid',$tabid);
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
                    if(optional($user->settings)->muted)
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
            ->with('items',$this->items)
            ->with('tabs',$tabs)
            ->with('tabid',$tabid);
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
            ->with('user',$user)
            ->with('items',$this->items);

    }
    public function user_block($userid)
    {
        $user = User::with('settings')->findOrFail($userid);
        if($user->settings->banned)
        {
            $user->settings->banned=0;
            $message='unbanned';
        }
        else
        {
            $user->settings->banned=1;
            $message='banned';
        }
        $user->settings->save();
        //dd(__METHOD__,$user->settings->smessage);
        session()->flash('success','User '.$user->login.' is are '.$message.'!');
        return redirect()->back();
    }
    public function user_muted($userid)
    {
        $user = User::with('settings')->findOrFail($userid);
        if($user->settings->muted)
        {
            $user->settings->muted=0;
            $message='unmuted';
        }
        else
        {
            $user->settings->muted=1;
            $message='muted';
        }
        $user->settings->save();
        session()->flash('success','User '.$user->login.' is are '.$message.'!');
        return redirect()->back();
    }
    public function user_hidden($userid)
    {
        $user = User::with('settings')->findOrFail($userid);
        if($user->settings->hidden)
        {
            $user->settings->hidden=0;
            $message='visible';
        }
        else
        {
            $user->settings->hidden=1;
            $message='hidden';
        }
        $user->settings->save();
        session()->flash('success','You make user '.$user->login.' is a '.$message.'!');
        return redirect()->back();
    }
    public function groups($sort=0,$view=0)
    {
        //$group_data = Group::with(['follow'])->get();
        $groups = (new Groups())->getGroup();
        //$groups = $groups->getGroup();
        // $group_data = collect();
//        foreach ($groups as $group)
//        {
//            dump($group);
//        }
//        dd(1);
        //dd($group->getGroupFollows());
        return view('admin.group')
            ->with('groups',$groups)
            ->with('items',$this->items);
    }
    public function groupVisibility($groupid)
    {
        $group = Group::find($groupid);
        if ($group->visibility) {
            $group->visibility = false;
        }
        else
        {
            $group->visibility = true;
        }
        $group->save();
        session()->flash('success','Group '.$group->name.' is modify!');
        return redirect(route('admin.groups'));
    }
    public function groupOpen($groupid)
    {
        $group = Group::find($groupid);
        if ($group->open) {
            $group->open = false;
        }
        else
        {
            $group->open = true;
        }
        $group->save();
        session()->flash('success','Group '.$group->name.' is modify!');
        return redirect(route('admin.groups'));
    }
}
