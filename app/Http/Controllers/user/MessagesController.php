<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Messages;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessagesController extends Controller
{
    public function message_send(Request $request,$user)
    {
        $auth_user=Auth::user();
        $user=User::find($user);
        if($auth_user)
        {
            if($user)
            {
                $message = Messages::create([
                    'user_id' => $user->id,
                    'sender_id' => $auth_user->id,
                    'subject' => $request->subject,
                    'type' => 1,
                    'hidden' => false,
                    'text' => $request->message,
                    'readed'=> false
                ]);
                return redirect()->back()->with(['success' => 'Message for '.$user->login.' send!','show' => $auth_user->getNotifications()]);
            }
            return redirect()->back()->withErrors('User not found!');
        }
        return redirect()->back()->withErrors('You don`t have permission!');
    }
    public function message_delete($id)
    {
        $user = Auth::user();
        $message = Messages::find($id);
        if($user && $message->checkRecipientUser())
        {
            if(!is_null($message))
            {
                $message->delete();
                return redirect()->back()->with(['success' => 'Message '.$message->subject.' deleted!','show' => $user->getNotifications()]);
            }
            return redirect()->back()->withErrors('Message not found!');
        }
        return redirect()->back()->withErrors('You don`t have permission!');
    }
}
