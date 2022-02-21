<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Connect;
use App\Models\Ip;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IpController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ip  $ip
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ip $ip)
    {
        if($request->has('ban'))
        {
            $ip->ban = true;
            $ip->bandate = Carbon::now()->add(30,'day');
        }
        if($request->has('unban'))
        {
            $ip->ban = false;
            $ip->bandate = Carbon::now();
        }
        if($request->get('ipName'))
        {
            $ip->name = $request->get('ipName');
        }
        if($request->get('description'))
        {
            $ip->description = $request->get('description');
        }
        $ip->save();
        session()->flash('success','IP :'.$ip->ip.' is are update!');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ip  $ip
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ip $ip)
    {
        $count = $ip->connect()->delete();
        session()->flash('success','Log for IP: '.$ip->ip.' is are cleared! Removed: '.$count.' records');
        return redirect()->back();
    }
}
