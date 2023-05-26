<?php

namespace App\Http\Controllers\Album;

use App\cps\Groups;
use App\Http\Controllers\MainController;
use App\Models\Album;
use App\Models\AlbumUnit;
use App\Models\Group;
use App\Models\Post;
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
        dd(__METHOD__,$album);
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
        dd(__METHOD__,$album);
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
        if ($request->hasFile('image'))
        {
            $file = $request->file('image');
            $extension = $file->extension();
            $name = $request->get('unitName');
            if(empty($name))$name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $hash_name = $file->hashName();
            $path = $file->storeAs(
                'public/groups/albums', $hash_name
            );
            AlbumUnit::create([
                'album_id' => $album->id,
                'post_id' => 0,
                'user_id' => Auth::id(),
                'comment_id'=>0,
                'blocked'=>false,
                'visible'=>$request->get('visible',0),
                'public'=>$request->get('public',0),
                'open'=>$request->get('open',0),
                'name' => $name,
                'format'=> $extension,
                'discription'=>$request->get('description'),
                'rate'=> 0,
                'hash_name'=>$hash_name,
                'patch'=>$path,
            ]);
            session()->flash('success',$album->name.' album foto added!');
            return redirect()->back();
        }
        return redirect()->back()->withErrors('Image not found!');
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
     * @param AlbumUnit $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Album $album, AlbumUnit $unit)
    {
        session()->flash('warning',$album->name.' unit delete!');
        $unit->delete();
        return redirect()->route('album.show',$album);
    }
}
