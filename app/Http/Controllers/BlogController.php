<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BlogController extends MainController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd(__METHOD__,'Ok');
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        dd(__METHOD__,'Create Ok');
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd(__METHOD__,$request->all());
        if ($request->hasFile('pic'))
        {
            $file = $request->file('pic');
            $hash_name = $file->hashName();
            $path = $file->storeAs(
                'public/blogs/pic', $hash_name
            );
        }
        else
        {
            $hash_name = 'no-pic.jpg';
            $path = 'no-pic.jpg';
        }
        $user = Auth::user();
        $album = Blog::create([
            'user_id'=>$user->id,
            'group_id'=>0,
            'blocked' => $request->get('hidden'),
            'titel'=>$request->get('titel'),
            'text'=>$request->get('text'),
            'hash_name'=>$hash_name,
            'patch'=>$path,
        ]);
        return redirect()->route('home');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        //
    }
}
