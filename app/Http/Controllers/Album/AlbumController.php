<?php

namespace App\Http\Controllers\Album;

use App\cps\Groups;
use App\Http\Controllers\MainController;
use App\Models\Album;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AlbumController extends MainController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        dd(__METHOD__,'index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Group $group
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('avatar'))
        {
            $file = $request->file('avatar');
            $hash_name = $file->hashName();
            $path = $file->storeAs(
                'public/groups/albums/avatar', $hash_name
            );
        }
        else
        {
            $hash_name = 'no-avatar.png';
            $path = 'no-avatar.png';
        }
        $group = 0;
        $user = Auth::user();
        $dirname = 'user/'.$user->login;
        if(session()->has('groupid'))
        {
            $group = (new Groups(session('groupid')))->getGroup();
            $dirname = 'group/'.$group->name;
            $group = $group->id;
        }
        $album = Album::create([
            'group_id'=>$group,
            'user_id'=>$user->id,
            'name' => $request->get('AlbumName'),
            'visible'=>$request->get('visible',0),
            'dir'=>$dirname,
            'location'=>'group',
            'description'=>$request->get('description'),
            'public'=>$request->get('public',0),
            'open'=>$request->get('open',0),
            'lock'=>false,
            'lock_key'=>'null',
            'rate'=>0,
            'hash_name'=>$hash_name,
            'patch'=>$path,
        ]);
        return redirect()->route('album.show',$album);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function show(Album $album)
    {
        if($album)
        {
            if($album->open)
            {
                if($album->group_id)
                {
                    $group = new Groups($album->group_id);
                    if($group)
                    {
                        if ($group->isGroupOpen() or Auth::user()->IsAdmin())
                        {
                            $albumunits = $album->albumunit;
                            $albums = $group->getGroupAlbum()->reverse();
                            $albums->load('albumunit');
                            $group = $group->getGroup();
                            $links = [
                                ['name'=>'Groups','route'=>'group.list','id'=>null],
                                ['name'=>$group->name,'route'=>'group.info','id'=>$group->id],
                                ['name'=>$album->name,'route'=>'album.show','id'=>$album->id]
                            ];
                            return view('album')
                                ->with('links',$links)
                                ->with('album',$album)
                                ->with('albums',$albums)
                                ->with('albumunits',$albumunits);
                        }
                        else
                        {
                            session()->flash('warning','Access to group denied');
                            return redirect()->back();
                        }
                    }
                    else
                    {
                        session()->flash('warning','Group not found');
                        return redirect()->back();
                    }

                }
                else
                {
                    $user = $album->user;
                    if($user)
                    {
                        $albumunits = $album->albumunit;
                        $albums = $user->albums->reverse();
                        $albums->load('albumunit');
                        $links = [
                            ['name'=>'Users','route'=>'user.users','id'=>null],
                            ['name'=>$user->login,'route'=>'user.info','id'=>$user->id],
                            ['name'=>$album->name,'route'=>'album.show','id'=>$album->id]
                        ];
                        return view('album')
                            ->with('links',$links)
                            ->with('album',$album)
                            ->with('albums',$albums)
                            ->with('albumunits',$albumunits);
                    }
                    else
                    {
                        session()->flash('warning','User not found');
                        return redirect()->back();
                    }
                }
            }
            else
            {
                session()->flash('warning','Access to album denied');
                return redirect()->back();
            }
        }
        return redirect()->route(session()->has('groupid') ? 'group.info' : 'group.list',session()->has('groupid') ? session('groupid') : null)->withErrors(['Album' => 'Album not found!']);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function edit(Album $album)
    {
        //
        dd(__METHOD__,$album);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Album $album)
    {
        //
        if ($request->hasFile('avatar'))
        {
            if($album->avatar)
            {
                Storage::delete($album->patch);
            }
            $file = $request->file('avatar');
            $album->hash_name = $file->hashName();
            $album->patch = $file->storeAs(
                'public/groups/albums/avatar', $album->hash_name
            );
            $album->avatar = true;
        }
        if($request->has('Albumname'))
        {
            $album->name = $request->get('AlbumName', 'Noname');
            $album->visible = $request->get('visible',0);
            $album->description = $request->get('description', 'empty');
            $album->public = $request->get('public',0);
            $album->open = $request->get('open',0);
        }
        $album->save();
        return redirect()->route('group.album',$album);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function destroy(Album $album)
    {
        session()->flash('warning','Album '.$album->name.' delete!');
        $album->delete();
        return  session()->has('groupid') ? redirect()->route('group.info',session('groupid')) : redirect()->route('user.info',Auth::id());
    }
}
