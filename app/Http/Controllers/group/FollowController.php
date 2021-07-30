<?php

namespace App\Http\Controllers\group;

use App\Http\Controllers\MainController;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Group;
use App\Models\Follow;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class FollowController extends MainController
{
    //
    public function following($groupid)
    {
        $user = Auth::user();
        $group = Group::find($groupid);
        $follow = $user->follow->where('group_id',$groupid)->first();
        if(!$follow)
        {
            if($user)
            {
                //Перегенерация ключа, если он есть в базе
                do{
                    $subscribekey = Str::random(36);
                } while (Follow::where("subscribe_key", "=", $subscribekey)->first() instanceof Follow);

                $follow=Follow::create([
                    'user_id' => $user->id,
                    'group_id' => $groupid,
                    'invite' => 0,
                    'invite_key' => 'free',
                    'subscribe_key' => $subscribekey,
                    'reputation' => 0
                ]);
                if($follow)
                {
                    return redirect(route('group.info', $groupid))->with(['success' => 'You following for this group!']);
                }
                return redirect(route('group.info', $group))->withErrors('Error for create following!');
            }
            return redirect(route('group.info', $group))->withErrors('Need to authenticate!');
        }
        return redirect(route('group.info', $group))->withErrors('You are follower in this group!');
    }
    public function unfollowing($groupid)
    {
        $user = Auth::user();
        if($user)
        {
            $follow = $user->follow->where('group_id',$groupid)->first();
            $follow->delete();
            return redirect(route('group.info', $groupid))->with(['success' => 'You unfollowing from this group!']);
        }
        return redirect(route('group.info', $group))->withErrors('Need to authenticate!');
    }
}
