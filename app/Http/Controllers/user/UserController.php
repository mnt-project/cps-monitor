<?php

namespace App\Http\Controllers\user;

use App\cps\Users;
use App\Http\Controllers\MainController;
use App\Http\Requests\uLoginRequest;
use App\Http\Requests\PasswordRequest;
use App\Models\RatingUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Parametr;
use App\Models\Avatar;
use App\Models\Group;
use App\Models\Follow;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class UserController extends MainController
{
    public function user_signin()
    {
        if(Auth::check())
        {
            return redirect()->back()->withErrors(['saveError' => 'You are already authenticate as '.Auth::user()->login]);
        }
        return view('login');
    }
    public function user_getreg()
    {
        if(Auth::check())
        {
            $user = Auth::user();
            return redirect()->route('user.profile',$user);
        }
        return view('registration');
    }
    public function user_logout()
    {
        if(Auth::check())
        {
            $user=Auth::user();

            Cache::forget('user-is-online-'.Auth::id());
            Auth::logout();
            $message = 'User: '.$user->login.' ID:['.$user->id.'] logout!';
            session()->flash('info',$message);
            Log::channel('connections')->info('[IP:'.\Request::ip().'] '.$message);
            session()->flash('notifications');
        }
        return redirect()->back();
    }
    public function user_login(uLoginRequest $request)
    {
        $data = $request->only(['email', 'password']);
        $rember = $request->get('remember');
        if ($rember) $rember = true;
        else $rember = false;
        if (Auth::attempt($data, $rember))
        {
            $user = User::findOrFail(Auth::id());
            $user->connects += 1;
            $user->save();
            $parametr = Parametr::where('user_id', $user)->get();
            if (is_null($parametr)) {
                Parametr::create([
                    'user_id' => $user,
                ]);
            }
            $user->parametr->connected_at = now();
            $user->parametr->save();
            $message = 'User: '.$user->login.' ID:['.$user->id.'] logged!';
            session(['notifications' => $user->parametr->notifications == 1 ]);
            session()->flash('info',$message);
            Log::channel('connections')->info('[IP:'.\Request::ip().'] '.$message);
            return redirect()->intended(route('user.info', $user->id));//Редирект на место
        }
        return redirect(route('user.login'))->withErrors('Неправильный пароль!');
    }
    public function user_profile($id = 1,$tabid=1)
    {
        if(Auth::check())
        {
            //$user = new Users($id);
            //dump(__METHOD__,$user->getUser());
            $user = User::find($id);
            if(empty($user))//Если user не найден, то загрузить профиль текущего
            {
                return redirect()->route('user.users')->withErrors('User not found!');
            }
            $user->load('parametr','avatar','follow','messages');
            return view('profile')
                ->with('user', $user)
                ->with('tabid', $tabid);
        }
        return redirect(route('user.login'))->withErrors('Ошибка авторизации!');
    }
    public function user_info($id = 1)
    {
        $user = User::with(['parametr','avatar'])->findOrFail($id);
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
    public function all_users()
    {
        $user = Auth::user();
        //$users = $users->forget(0);
        if($user)
        {
            $users = User::where('id','>',0)->paginate(30);
            if($users)
            {
                return view('users')
                    ->with('users', $users);
            }
            return redirect()->back()->withErrors('Users not found!');
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
        $parametr = Parametr::create([
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
                $user->parametr->muted = $muted;
            }
            if($admin)
            {
                $user->parametr->admin = $admin;
            }
            //dd(__METHOD__,$user->parametr);
            $user->fill($udata);
            if($pass)
            {
                $user->password = $pass;
            }
            $user->parametr->save();
            $user->save();
            session()->flash('success','User: '.$user->login.' ID:['.$id.'] updated!');
            return redirect(route('user.profile',$id));
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
                Avatar::create(
                [
                    'user_id' => $id,
                    'hash_name' => $file->hashName(),
                    'patch' => $path,
                ]);
            session()->flash('success','Avatar is uploaded!');
            return redirect()->back();
        }
        return redirect()->back()->withErrors(['saveError' => 'Avatar is not selected!']);
    }
    public function user_smessage(Request $request,$id)
    {
        $user=User::find($id);
        $auth_user = User::find(Auth::id());
        $message = $request->input('statusMessage');

        if( $auth_user->id == $id or $auth_user->role)
        {
            if(empty($message))
            {
                $user->parametr->status = false;
                $user->parametr->smessage = '';
                $message = 'Status message deleted';
            }
            else
            {
                $user->parametr->status = true;
                $user->parametr->smessage = $message;
                $message = 'New status message: '.$message;
            }
            $user->parametr->save();
            session()->flash('success',$message);
            return redirect()->back();
        }
        return redirect()->back()->withErrors('You don`t have permission!');
    }
    public function user_hidden($id)
    {
        $user=User::find($id);
        $hidden=$user->parametr->hidden;
        //$message = '';
        if($user)
        {
            if($hidden)
            {
                $hidden=false;
                $message = 'Profile is opened';
            }
            else
            {
                $hidden=true;
                $message = 'Profile is closed';
            }
            $user->parametr->hidden=$hidden;
            $user->parametr->save();
            session()->flash('success',$message);
            return redirect()->back();
            //dd(__METHOD__,$user);
        }
        return redirect()->back()->withErrors('You don`t have permission!');
    }
    public function user_notifications($id)
    {
        $user=User::find($id);
        $notifications=$user->parametr->notifications;
        //$message = '';
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
            $user->parametr->notifications=$notifications;
            $user->parametr->save();
            session()->flash('success',$message);
            session(['notifications' => $notifications]);
            return redirect()->back();
            //dd(__METHOD__,$user);
        }
        return redirect()->back()->withErrors('You don`t have permission!');
    }
    public function user_nickname(Request $request,$id)
    {
        $auth_user=User::find(Auth::id());
        $user = User::find($id);
        $nickname = $request->get('newnickname');
        if(!empty($nickname))
        {
            if($auth_user->id == $user->id or $auth_user->parametr->admin)
            {
                $message=$user->login.' change nickname to '.$nickname;
                $user->login = $nickname;
                $user->save();
                session()->flash('success',$message);
                return redirect()->back();
            }
            return redirect()->back()->withErrors('You don`t have permission!');
        }
        return redirect()->back()->withErrors('Enter new nickname into a field!');

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
                session()->flash('success',"Password changed!");
                return redirect()->back();
            }
            return redirect()->back()->withErrors('Incorrect current password!');
        }
        return redirect()->back()->withErrors('Password mismatch!');

    }
    public function user_about(Request $request,$id)
    {
        $user = User::find($id);
        $about = $request->only('interests','about','notes');
        if(Auth::id()==$user->id)
        {
            if(!is_null($about['interests'])){$user->parametr->interests = $about['interests'];}
            if(!is_null($about['interests'])){$user->parametr->about = $about['about'];}
            if(!is_null($about['interests'])){$user->parametr->notes = $about['notes'];}
            $user->parametr->save();
            session()->flash('success',"About changed!");
            return redirect()->back();
        }
        return redirect()->back()->withErrors('You don`t have permission!');
    }
    public function user_reputationup($id)
    {
        $auth_user=User::find(Auth::id());
        $user = User::find($id);
        if($auth_user->id!=$user->id)
        {
            $rate=$auth_user->ratinguser()->where('rated_id',$id);
            //$rate=RatingUser::where('user_id',Auth::id())->get();
            if($rate->count() == 0)
            {
                RatingUser::create([
                    'user_id'=>$auth_user->id,
                    'rated_id'=>$id,
                    'rate'=>true,
                    'value'=>1,
                ]);
                $user->parametr->reputation++;
                $user->parametr->save();
                session()->flash('success',"User ".$user->login." rated!");
                return redirect()->back();
            }
            return redirect()->back()->withErrors('You already rated this user!');
        }
        return redirect()->back()->withErrors('You can`t rate yourself!');
    }
    public function user_reputationdown($id)
    {
        $auth_user=User::find(Auth::id());
        $user = User::find($id);
        if($auth_user->id!=$user->id)
        {
            $rate=$auth_user->ratinguser()->where('rated_id',$id);
            //$rate=RatingUser::where('user_id',Auth::id())->get();
            if($rate->count() == 0)
            {
                RatingUser::create([
                    'user_id'=>$auth_user->id,
                    'rated_id'=>$id,
                    'value'=>-1,
                ]);
                $user->parametr->reputation--;
                $user->parametr->save();
                session()->flash('success',"User ".$user->login." rated!");
                return redirect()->back();
            }
            return redirect()->back()->withErrors('You already rated this user!');
        }
        return redirect()->back()->withErrors('You can`t rate yourself!');
    }
    public function users_parametrs_update()
    {
        $auth_user=User::findOrFail(Auth::id());
        if($auth_user->role)
        {
            $affected = 0;
            $users = User::get();
            foreach ($users as $user)
            {
                $parametr = Parametr::where('user_id',$user->id)->get();
                if(empty($parametr))
                {
                    $parametr = parametr::create([
                        'user_id' => $user->id,
                    ]);
                    if($parametr)
                    {
                        $affected++;
                    }
                }
            }
            return redirect(route('user.info',$auth_user->id))->with(['success' => 'Users parametrs: '.$affected.' added in base !','show'=> $auth_user->parametr->notifications]);
        }
        return redirect(route('home'))->withErrors('You don`t have permission!');
    }
    //
}
