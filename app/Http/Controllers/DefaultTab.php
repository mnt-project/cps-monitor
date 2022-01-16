<?php

namespace App\Http\Controllers;

use App\cps\user\Tabs;
use Illuminate\Http\Request;

class DefaultTab extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($tabid=0)
    {
        return redirect()->back();
        //dd(__METHOD__,$tabid);
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($value,$titel,$type,$route)
    {
        $tab = (new Tabs($value,$titel,$type,$route,true))->getTab();
        //dd(__METHOD__,$tab->tabid);
        return redirect()->route('admin.community',$tab->tabid);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function close(\App\Models\Tabs $tab)
    {
        $tab->delete();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tabs  $tabs
     * @return \Illuminate\Http\Response
     */
    public function show(Tabs $tabs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tabs  $tabs
     * @return \Illuminate\Http\Response
     */
    public function edit(Tabs $tabs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tabs  $tabs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tabs $tabs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tabs  $tabs
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tabs $tabs)
    {
        //
    }
}
