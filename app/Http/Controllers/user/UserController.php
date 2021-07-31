<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\MainController;
use App\Http\Requests\uLoginRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\uParametr;
use App\Models\Avatar;
use App\Models\Group;
use App\Models\Follow;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class UserController extends MainController
{
    public function user_signin()
    {
        if(Auth::check())
        {
            $user = Auth::user();
            return redirect()->intended(route('user.profile',$user));
        }
        return view('login');
    }
    public function user_getreg()
    {
        if(Auth::check())
        {
            $user = Auth::user();
            return redirect()->intended(route('user.profile',$user));
        }
        return view('registration');
    }
    public function user_logout()
    {
        if(Auth::check())
        {
            Cache::forget('user-is-online-' . Auth::user());
            Auth::logout();
        }
        return redirect('/login');
    }
    public function user_login(uLoginRequest $request)
    {
        $rember = $request->get('remember');
        if($rember)$rember=true;
        else $rember=false;
        $data = $request->only(['email','password']);
        if(Auth::attempt($data,$rember))
        {
            $user = Auth::user();
            $user->connects += 1;
            $user->save();
            $parametr = uParametr::where('user_id',$user)->get();
            if(is_null($parametr))
            {
                $parametr = uParametr::create([
                    'user_id' => $user,
                ]);
            }
            $user->uparametr->connected_at = now();
            $user->uparametr->save();
            return redirect()->intended(route('user.info',$user->id))
                ->with(['success' => 'User: '.$user->login.' ID:['.$user->id.'] loged!','show' => $user->uparametr->notifications]);//Редирект на место
        }
        else return redirect(route('user.login'))->withErrors('Неправильный пароль!');

    }
    public function user_profile($id = 1,$tabid=0)
    {
        if(Auth::check())
        {
            $user = User::find($id);
            if(empty($user))//Если user не найден, то загрузить профиль текущего
            {
                return redirect()->route('user.users')->withErrors('User not found!');
            }
            $user->load('uparametr','avatar','follow');
            return view('profile')
                ->with('user', $user)
                ->with('tabid', $tabid);
        }
        return redirect(route('user.login'))->withErrors('Ошибка авторизации!');
    }
    public function user_info($id = 1)
    {
        if(Auth::check())
        {
            $user = User::with(['uparametr','avatar'])->find($id);
            $follows = Follow::where('user_id',$user->id)->get();
            $groups = Group::get();
            $subscribes = collect();
            if($follows)
            {
                foreach ($follows as $follow)
                {
                    $subscribes = $subscribes->push($groups->find($follow->group_id));
                }

            }
            return view('user')
                ->with('user', $user)
                ->with('groups', $subscribes);
        }
    }
    public function all_users()
    {
        $user = Auth::user();
        $users = User::where('id','>',0)->paginate(30);
        //$users = $users->forget(0);
        if($user)
        {
            if($users)
            {
                return view('users')
                    ->with('users', $users);
            }
            return redirect(route('user.info',$user->id))->withErrors('Users not found!');
        }
        return redirect(route('user.login'))->withErrors('Ошибка авторизации!');
    }
    public function user_registration(uLoginRequest $request)
    {
        if(Auth::check())
        {
            return redirect(route('user.profile'));
        }
        //dd(__METHOD__,$request);
        //$user=User::create($request);
        $data = $request->only(['login','email','age','password']);
        $user = User::create($data);
        $parametr = uParametr::create([
            'user_id' => $user->id,
        ]);
        //dd(__METHOD__,$parametr);
        if($user)
        {
            if($parametr)
            {
                Auth::login($user);
                return redirect(route('user.profile', $user));
            }
            return redirect(route('user.login'))->withErrors(['saveError' => 'Error to save parameters!']);
        }
        return redirect(route('user.login'))->withErrors(['saveError' => 'Save error!']);
    }
    public function user_save(Request $request,$id)
    {
        $user = User::find($id);
        //dd(__METHOD__,$request);
        if($user)
        {
            $udata = $request->only('login','group','role','email','age');
            $pass = $request->get('password');
            $muted = $request->get('muted',0);
            $admin = $request->get('admin',0);
            if($muted)
            {
                $user->uparametr->muted = $muted;
            }
            if($admin)
            {
                $user->uparametr->admin = $admin;
            }
            //dd(__METHOD__,$user->uparametr);
            $user->fill($udata);
            if($pass)
            {
                $user->password = $pass;
            }
            $user->uparametr->save();
            $user->save();

            return redirect(route('user.profile',$id))->with(['success' => 'User: '.$user->login.' ID:['.$id.'] updated!','show'=> $user->uparametr->notifications]);
        }
        return redirect(route('user.profile'))->withErrors(['saveError' => 'Save error! User not found']);
    }
    public function user_avatar(Request $request,$id)
    {
        //dd(__METHOD__,$id);
        $user = User::find($id);
        if($user->avatar)
        {
            Storage::delete($user->avatar->patch);
            $user->avatar->delete();

            //return redirect(route('user.profile'))->withErrors(['saveError' => 'You already have avatar!']);
        }
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');

            $path = $request->file('avatar')->storeAs(
                'public/avatars', $file->hashName()
            );
            $ava = Avatar::create(
                [
                    'user_id' => $id,
                    'hash_name' => $file->hashName(),
                    'patch' => $path,
                ]);
            return redirect(route('user.profile',$id))->with(['success' => 'Avatar is uploaded!','show'=> $user->uparametr->notifications]);
        }
        return redirect(route('user.profile',$id))->withErrors(['saveError' => 'Avatar is not selected!']);
//        switch ($request->get('item'))
//        {
//            case 1:$message='Test 1';break;
//            case 2:$message='Test 2';break;
//            case 3:$message='Test 3';break;
//            case 4:$message='Test 4';break;
//        }
    }
    public function user_smessage(Request $request,$id)
    {
        $user=User::find($id);
        $auth_user = Auth::user();
        $message = $request->input('statusMessage');
        if($auth_user->id == $id or $auth_user->uparametr->admin)
        {
            if(empty($message))
            {
                $user->uparametr->status = false;
                $message = 'Status message deleted';
            }
            else
            {
                $user->uparametr->status = true;
                $user->uparametr->smessage = $message;
                $message = 'New status message: '.$message;
            }
            $user->uparametr->save();
            return redirect(route('user.profile',$id))
                ->with(['success' => $message,'show' => $user->uparametr->notifications]);
        }
        return redirect(route('user.profile',$id))->withErrors('You don`t have permission!');
    }
    public function user_notifications($id)
    {
        $user=User::find($id);
        $notifications=$user->uparametr->notifications;
        $message = '';
        if($user)
        {
            if($notifications)
            {
                $notifications=false;
                $message = 'Notifications off';
            }
            else
            {
                $notifications=true;
                $message = 'Notifications on';
            }
            $user->uparametr->notifications=$notifications;
            $user->uparametr->save();
            return redirect(route('user.profile',['id'=>$id,'tabid'=>4]))
                ->with(['success' => $message,'show' => true]);
            //dd(__METHOD__,$user);
        }
    }
    public function user_nickname(Request $request,$id)
    {
        $auth_user=Auth::user();
        $user = User::find($id);
        $nickname = $request->get('newnickname');
        if(!empty($nickname))
        {
            if($auth_user->id == $user->id or $auth_user->uparametr->admin)
            {
                $message=$user->login.' change nickname to '.$nickname;
                $user->login = $nickname;
                $user->save();
                return redirect(route('user.profile',['id'=>$id,'tabid'=>4]))
                    ->with(['success' => $message,'show' => true]);
            }
            return redirect(route('user.profile',['id'=>$id,'tabid'=>4]))
                ->withErrors('You don`t have permission!');
        }
        return redirect(route('user.profile',['id'=>$id,'tabid'=>4]))
            ->withErrors('Enter new nickname into a field!');

    }
    public function user_password(PasswordRequest $request,$id)
    {
        $user = User::find($id);
        $pass = $request->only('old_password','new_password','confirm_password');
        if($pass['new_password'] == $pass['confirm_password'])
        {
            if($user->checkCurrentPassword($pass['old_password']))
            {
                $user->setPasswordAttribute($pass['new_password']);
                $user->save();
                return redirect(route('user.profile',['id'=>$id,'tabid'=>4]))
                    ->with(['success' => "Password changed!",'show' => true]);
            }
            return redirect(route('user.profile',['id'=>$id,'tabid'=>4]))
                ->withErrors('Incorrect current password!');
        }
        return redirect(route('user.profile',['id'=>$id,'tabid'=>4]))
            ->withErrors('Password mismatch!');

    }
    public function user_about(Request $request,$id)
    {
        $user = User::find($id);
        $about = $request->only('interests','about','notes');
        if(Auth::id()==$user->id)
        {
            if(!is_null($about['interests'])){$user->uparametr->interests = $about['interests'];}
            if(!is_null($about['interests'])){$user->uparametr->about = $about['about'];}
            if(!is_null($about['interests'])){$user->uparametr->notes = $about['notes'];}
            $user->uparametr->save();
            return redirect(route('user.profile',['id'=>$id,'tabid'=>4]))
                ->with(['success' => "About changed!",'show' => true]);
        }
        return redirect(route('user.profile',['id'=>$id,'tabid'=>4]))
            ->withErrors('You don`t have permission!');
    }
    public function user_reputationup($id)
    {
        $user = User::find($id);
        dd(__METHOD__,$user);
    }
    public function user_reputationdown($id)
    {
        $user = User::find($id);
        dd(__METHOD__,$user);
    }
    public function users_parametrs_update()
    {
        $auth_user=Auth::user();
        if($auth_user->role)
        {
            $affected = 0;
            $users = User::get();
            foreach ($users as $user)
            {
                $parametr = uParametr::where('user_id',$user->id)->get();
                if(empty($parametr))
                {
                    $parametr = uParametr::create([
                        'user_id' => $user->id,
                    ]);
                    if($parametr)
                    {
                        $affected++;
                    }
                }
            }
            return redirect(route('user.info',$auth_user->id))->with(['success' => 'Users parametrs: '.$affected.' added in base !','show'=> $auth_user->uparametr->notifications]);
        }
        return redirect(route('home'))->withErrors('You don`t have permission!');
    }
    //
}
