<?php

namespace App\Http\Controllers\group;

use App\Http\Controllers\MainController;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends MainController
{
    //
    public function post_quote($text)
    {
        session()->put('quote','[quote] '.$text.' [/quote]');

        return redirect()->back();
    }
    public function post_create(Request $request,$group)
    {
        if(session()->has('quote'))session()->forget('quote');
        $post=$request->input('post');
        if($post)
        {
            //dd(__METHOD__,$group);
            $post = Post::create([
                'group_id' => $group,
                'user_id' => Auth::id(),
                'description' => $post,
                'winfo' => 'null',
            ]);
            //dd(__METHOD__,$post);
            return redirect()->back()->with(['success' => 'Post was created!']);
        }
        return redirect()->back()->withErrors('Message is empty!');
    }

    /**
     * @param $post
     * @param $value
     * @return \Illuminate\Http\RedirectResponse
     */
    public function post_reputation($post, $value)
    {
        $post = Post::find($post);
        if($post)
        {
            if($value>0)$post->plus=$post->plus+1;
            else $post->minus=$post->minus+1;
            $post->save();
            return redirect()->back()->with(['success' => 'You change post reputation!']);
        }
        return redirect()->back()->withErrors('Post not found!');
        //dd(__METHOD__,$post->plus);
    }
    public function post_delete($postid)
    {
        $post = Post::find($postid);
        if($post)
        {
            $groupid = $post->group_id;
            if ($post) {
                //$group = $post->group->id;
                $post->delete();
                return redirect(route('group.info',$groupid))->with(['warning' => 'Post of '.$post->user->login.' deleted!']);
            }
            return redirect(route('group.info',$groupid))->withErrors(['saveError' => 'Post not found!']);
        }
        return redirect()->intended(route('group.list'));
    }
}
