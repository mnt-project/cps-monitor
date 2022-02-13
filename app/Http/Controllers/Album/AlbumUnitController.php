<?php

namespace App\Http\Controllers\Album;

use App\cps\Groups;
use App\Http\Controllers\MainController;
use App\Models\Album;
use App\Models\AlbumUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlbumUnitController extends MainController
{
    /**
     * Display a listing of the resource.
     *
     * @param Album $album
     * @return void
     */
    public function index(Album $album)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Album $album
     * @return void
     */
    public function create(Album $album)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Album $album
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Album $album)
    {
        //dd(__METHOD__,$album);
        if(session()->has('groupid'))
        {
            $group = (new Groups(session('groupid')))->getGroup();
            if(empty($group->albumid))
            {
                $id=$group->id;
                while (AlbumUnit::where("album_id", "=", $id)->first() instanceof AlbumUnit)
                {
                    $id++;
                }
                $group->albumid = $id;
                $group->save();
            }else $id=$group->albumid;
        }
        else
        {
            //Todo: Привязка к альбомов к постам if(session()->has('postid'))
            $id=0;
            while (AlbumUnit::where("album_id", "=", $id)->first() instanceof AlbumUnit)
            {
                $id++;
            }
        }
        //Todo: change file name
        if ($request->hasFile('album'))
        {
            $file = $request->file('album');
            $discription = $request->input('discription');
            $extension = $file->extension();
            $name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $hash_name = $file->hashName();
            $path = $file->storeAs(
                'public/groups/albums', $hash_name
            );
            AlbumUnit::create([
                'album_id' => $id,
                'post_id' => 0,
                'user_id' => Auth::id(),
                'name' => $name,
                'format'=> $extension,
                'discription'=>$discription,
                'rate'=> 0,
                'hash_name'=>$hash_name,
                'patch'=>$path,
            ]);
            session()->flash('success','Group '.$group->name.' album foto added!');
            return redirect()->back();
        }
        return redirect()->back()->withErrors(['saveError' => 'Avatar is not selected!']);
    }

    /**
     * Display the specified resource.
     *
     * @param Album $album
     * @param \App\Models\AlbumUnit $albumUnit
     * @return void
     */
    public function show(Album $album, AlbumUnit $albumUnit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Album $album
     * @param \App\Models\AlbumUnit $albumUnit
     * @return void
     */
    public function edit(Album $album, AlbumUnit $albumUnit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AlbumUnit  $albumUnit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Album $album, AlbumUnit $albumUnit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Album $album
     * @param \App\Models\AlbumUnit $albumUnit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Album $album, AlbumUnit $albumUnit)
    {
        //
        session()->flash('warning','Album unit '.$album->id.' delete!');
        $album->delete();
        return redirect()->route('group.info',session('groupid'));
    }
}
