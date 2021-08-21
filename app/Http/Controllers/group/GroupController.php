<?php

namespace App\Http\Controllers\group;

use App\Http\Controllers\MainController;
use App\Models\Follow;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Group;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\uParametr;
use Illuminate\Support\Str;

class GroupController extends MainController
{
    //
    public function group_list($sort=0)
    {

        $user = User::find(Auth::id());
        $names = ['No sort','Sort by id','Sort by id desc','Sort by name','Sort by name desc','Sort by update','Sort by update desc','Sort by subscribe','Sort by subscribe desc','Only followed'];
        if($user)
        {
            if($user->uparametr->admin)//Если админ, создать коллекцию всех групп
            {
                $group_data = Group::with(['follow'])->get();
            }
            else//Если не админ и не гость, создать коллекцию публичных групп
            {
                $group_data = Group::with(['follow'])->where('public', 1)->get();
            }
        }
        else
        {
            $user = User::find(0);
            $group_data = Group::with(['follow'])->where('public', 1)->get();
        }
        $sorted = collect();
        if($user->id!=0)
        {
            $sortid = $user->uparametr->sort;
            if($sort)
            {
                if($sortid!=$sort)
                {
                    $user->uparametr->sort = $sort;
                    $user->uparametr->save();
                }
            }
            else
            {
                if($sortid)
                {
                    $sort = $sortid;
                }
            }
        }
        switch($sort)
        {
            case 0:
            {
                $sorted = $group_data;
                break;
            }
            case 1:
            {
                $sorted = $group_data->sortBy('id');
                break;
            }
            case 2:
            {
                $sorted = $group_data->sortByDesc('id');
                break;
            }
            case 3:
            {
                $sorted = $group_data->sortBy('name');
                break;
            }
            case 4:
            {
                $sorted = $group_data->sortByDesc('name');
                break;
            }
            case 5:
            {
                $sorted = $group_data->sortBy('updated_at');
                break;
            }
            case 6:
            {
                $sorted = $group_data->sortByDesc('updated_at');
                break;
            }
            case 7:
            {
                $sorted = $group_data->sortBy(function($group)
                {
                    return $group->follow->count();
                });
                break;
            }
            case 8:
            {
                $sorted = $group_data->sortByDesc(function($group)
                {
                    return $group->follow->count();
                });
                break;
            }
            case 9:
            {
                if($user)
                {
                    $subscribes = $user->follow;
                    foreach($subscribes as $subscribe)
                    {
                        $sorted = $sorted->push($group_data->find($subscribe->group_id));
                        $sorted = $sorted->sortBy('name');
                    }
                }
                break;
            }
        }
        return view('groups')
            ->with('user', $user)
            ->with('groups',$sorted)
            ->with('names',$names)
            ->with('sort',$sort);
    }
    public function group_edit(Request $request,$group)
    {
        //dd(__METHOD__,$request->ip());
        $user = User::find(Auth::id());;
        $group_data = Group::find($group);
        if($user->id == $group_data->user_id or $user->uparametr->admin) {
            $follow = Follow::where(['user_id' => $user->id, 'group_id' => $group_data->id])->get();
            if($follow->isEmpty())
            {
                Follow::create([
                    'user_id' => $user->id,
                    'group_id' => $group,
                    'invite' => 1,
                    'invite_key' => 'creator',
                    'subscribe_key' => 'creator-'.$group_data->name,
                    'reputation' => 100
                ]);
                return redirect(route('group.info', $group_data->id))->with(['success' => 'Creator follow added!','show'=> $user->uparametr->notifications]);
            }
            if ($group_data) {
                //dd(__METHOD__, $request);
                $name = $request->get('groupName');
                $notes = $request->get('groupNotes');
                $public = $request->get('public', 0);
                $open = $request->get('open', 0);
                $invite = $request->get('invite', 0);
                $about = $request->get('groupAbout');
                if ($request->hasFile('avatar'))
                {
                    $file = $request->file('avatar');
                    if($file)
                    {
                        $path = $request->file('avatar')->storeAs(
                            'public/groups/avatars', $file->hashName()
                        );
                        $group_data->hash_name = $file->hashName();
                        $group_data->patch = $path;
                        $group_data->avatar = true;
                    }
                }
                if ($group_data->name != $name) {
                    $group_data->name = $name;
                }
                if ($group_data->public != $public) {
                    $group_data->public = $public;
                }
                if ($group_data->open != $open) {
                    $group_data->open = $open;
                }
                if ($group_data->invite != $invite) {
                    $group_data->invite = $invite;
                }
                if ($group_data->notes != $notes) {
                    $group_data->notes = $notes;
                }
                if ($group_data->about != $about) {
                    $group_data->about = $about;
                }
                $group_data->save();
                return redirect(route('group.info', $group_data->id))->with(['success' => 'Group is modify!','show'=> $user->uparametr->notifications]);
            }
            return redirect(route('group.list'))->withErrors(['saveError' => 'Group not find!']);
        }
        return redirect(route('group.list'))->withErrors(['saveError' => 'You dont have permission to edit this group!']);
    }
    public function group_info($groupid=0,$text='')
    {
        //dd(__METHOD__,$text);
        $group = Group::where('id',$groupid)->first();
        $followers = Follow::with('user')->where('group_id',$groupid)->get();
        $posts = Post::with(['user','group'])->where('group_id',$groupid)->orderBy('created_at', 'desc')->get();
        if($group)
        {
            //dd(__METHOD__,$group_data);
            return view('group')
                ->with('group', $group)
                ->with('posts',$posts)
                ->with('followers',$followers)
                ->with('text',$text);
        }
        else
        {
            return redirect(route('group.list'))->withErrors(['saveError' => 'Group not found!']);
        }
    }
    public function group_add(Request $request)
    {
        //dd(__METHOD__,$request);
        //Storage::delete($user->avatar->patch);
        $user = User::find(Auth::id());;
        if($user)
        {
            $name = $request->get('groupName');
            $notes = $request->get('groupNotes');
            $public = $request->get('public',0);
            $open = $request->get('open',0);
            $invite = $request->get('invite',0);
            $about = $request->get('groupAbout');
            if($request->hasFile('avatar'))
            {
                $file = $request->file('avatar');

                $path = $request->file('avatar')->storeAs(
                    'public/groups/avatars', $file->hashName()
                );
                $group = Group::create(
                    [
                        'name' => $name,
                        'user_id' => $user->id,
                        'public' => $public,
                        'open' => $open,
                        'invite' => $invite,
                        'avatar' => true,
                        'hash_name' => $file->hashName(),
                        'patch' => $path,
                        'notes' => $notes,
                        'about' => $about,
                    ]);
                if($group)
                {
                    Follow::create(
                        [
                            'user_id' => $user->id,
                            'group_id' => $group->id,
                            'invite' => 1,
                            'invite_key' => 'creator',
                            'subscribe_key' => 'creator-'.$group->name,
                            'reputation' => 100
                        ]);
                    return redirect(route('group.list'))->with(['success' => 'Group is created!','show'=> $user->uparametr->notifications]);
                }
                else
                {
                    return redirect(route('group.list'))->withErrors(['saveError' => 'Group created error!']);
                }
            }
            return redirect(route('group.list'))->withErrors(['saveError' => 'Avatar is not selected!']);
        }
        return redirect(route('group.list'))->withErrors('Need to authenticate!');
    }
}
