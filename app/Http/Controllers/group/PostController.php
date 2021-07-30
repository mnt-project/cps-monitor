<?php

namespace App\Http\Controllers\group;

use App\Http\Controllers\MainController;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends MainController
{
    //
    public function post_create(Request $request,$group)
    {
        $post=$request->input('post');
        if($post)
        {
            $user = Auth::user();
            if ($user) {
                //dd(__METHOD__,$group);
                $post = Post::create([
                    'group_id' => $group,
                    'user_id' => $user->id,
                    'description' => $post,
                    'winfo' => 'null',
                ]);
                //dd(__METHOD__,$post);
                return redirect(route('group.info', $group))->with(['success' => 'Post was created!','show'=> $user->uparametr->notifications]);
            }
            return redirect(route('group.info', $group))->withErrors('Need to authenticate!');
        }
        return redirect(route('group.info', $group))->withErrors('Message is empty!');
    }
    public function post_reputation($post,$value)
    {
        $post = Post::find($post);
        if($post)
        {

            if($value>0)$post->plus=$post->plus+1;
            else $post->minus=$post->minus+1;
            $post->save();
            return redirect(route('group.info', $post->group->id))->with(['success' => 'You change post reputation!','show'=> $user->uparametr->notifications]);
        }
        return redirect(route('group.info', $group->group->id))->withErrors('Post not found!');
        //dd(__METHOD__,$post->plus);


    }
    public function post_delete($post)
    {
        $user = Auth::user();
        $post = Post::find($post);
        if($user)
        {
            if ($post) {
                $group = $post->group->id;
                $post->delete();
                return redirect(route('group.info', $group))->with(['warning' => 'Post of ' . $post->user->login . ' deleted!','show'=> $user->uparametr->notifications]);
            }
            return redirect(route('group.info', $group))
                ->withErrors(['saveError' => 'Post not found!']);
        }
        return redirect(route('group.info', $post->group_id))->withErrors('Need to authenticate!');

    }
}
