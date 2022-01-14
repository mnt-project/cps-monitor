<?php

namespace App\Http\Controllers\group;

use App\Http\Controllers\MainController;
use App\cps\Groups;
use App\Models\Follow;
use Illuminate\Http\Request;
use App\Models\Group;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class GroupController extends MainController
{
    //
    public function group_list($sort=0)
    {
        $names = ['No sort','Sort by id','Sort by id desc','Sort by name','Sort by name desc','Sort by update','Sort by update desc','Sort by subscribe','Sort by subscribe desc','Only followed'];
        if(Auth::check())
        {
            $user = User::find(Auth::id());
            if($user->settings->admin)//Если админ, создать коллекцию всех групп
            {
                $group_data = Group::with(['follow'])->get();
            }
            else//Если не админ и не гость, создать коллекцию публичных групп
            {
                $group_data = Group::with(['follow'])->where('public', 1)->get();
            }
            $sortid = $user->settings->sort;
            if($sort)
            {
                if($sortid!=$sort)
                {
                    $user->settings->sort = $sort;
                    $user->settings->save();
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
        else
        {
            $user = User::find(0);
            $group_data = Group::with(['follow'])->where('public', 1)->get();
        }
        $sorted = collect();
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
        if($user->id == $group_data->user_id or $user->settings->admin) {
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
                session()->flash('success','Creator follow added!');
                return redirect(route('group.info', $group_data->id));
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
                session()->flash('success','Group '.$group_data->name.' is modify!');
                return redirect(route('group.info', $group_data->id));
            }
            return redirect(route('group.list'))->withErrors(['saveError' => 'Group not find!']);
        }
        return redirect(route('group.list'))->withErrors(['saveError' => 'You dont have permission to edit this group!']);
    }
    public function group_avatar(Request $request,$id)
    {
        //dd(__METHOD__,$id);
        if ($request->hasFile('avatar'))
        {
            $group = Group::find($id);
            if($group->avatar)
            {
                Storage::delete($group->patch);
            }
            $file = $request->file('avatar');
            $name = $file->hashName();
            $path = $request->file('avatar')->storeAs(
                'public/groups/avatars', $name
            );
            $group->patch = $path;
            $group->hash_name = $name;
            $group->save();
            session()->flash('success','Group '.$group->name.' avatar changed!');
            return redirect()->back();
        }
        return redirect()->back()->withErrors(['saveError' => 'Avatar is not selected!']);
    }
    public function group_info($groupid=0,$text='')
    {
        $group = new Groups($groupid);

        if($group)
        {
            $followers = $group->getGroupFollows();
            $followers->load('user');
            $posts = $group->getGroupPosts();
            $posts->load('user','group');
            $group = $group->getGroup();
            $group->visits++;
            $group->save();
            return view('group')
                ->with('followers',$followers)
                ->with('posts',$posts)
                ->with('group', $group)
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
        $group = new Group();

        $user = User::find(Auth::id());;
        if($user)
        {
            $group->name = $request->get('groupName');
            $group->notes = $request->get('groupNotes');
            $group->public = $request->boolean('public');
            $group->open = $request->boolean('open');
            $group->invite = $request->boolean('invite');
            $group->about = $request->get('groupAbout');

            if($request->hasFile('avatar'))
            {
                $group->avatar = true;
                $file = $request->file('avatar');
                $group->hash_name = $file->hashName();
                $group->patch = $request->file('avatar')->storeAs('public/groups/avatars', $file->hashName());

                $group = (new Groups(0,0,true))->createGroup($group);
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
                    session()->flash('success','Group '.$group->name.' is created!');
                    return redirect(route('group.list'));
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
