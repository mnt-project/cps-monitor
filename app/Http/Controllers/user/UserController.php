<?php

namespace App\Http\Controllers\user;

use App\cps\user\Tabs;
use App\cps\Users;
use App\Http\Controllers\MainController;
use App\Http\Requests\uLoginRequest;
use App\Http\Requests\PasswordRequest;
use App\Models\RatingUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Settings;
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
            return redirect()->back()->withErrors(['saveError' => 'You are already authenticate as '.auth()->user()->login]);
        }
        return view('login');
    }
    public function user_getreg()
    {
        if(Auth::check())
        {
            return redirect()->route('user.profile',auth()->user()->id);
        }
        return view('registration');
    }
    public function user_logout()
    {
        $message = 'User: '.auth()->user()->login.' ID:['.auth()->user()->id.'] logout!';
        session()->flash('info',$message);
        session()->flash('notifications');
        if(session()->has('quote'))session()->forget('quote');
        Cache::forget('user-is-online-'.auth()->user()->id);
        Auth::logout();
        Log::channel('connections')->info('[IP:'.\Request::ip().'] '.$message);
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
            $user = User::findOrFail(auth()->user()->id);
            $user->connects += 1;
            $user->save();
            //$settings = Settings::where('user_id', $user)->get();
            self::user_create_settings($user);
            $user->load('settings');
            $user->settings->connected_at = now();
            $user->settings->save();
            $message = 'User: '.$user->login.' ID:['.$user->id.'] logged!';
            Tabs::deleteTabs();
            session(['notifications' => $user->settings->notifications == 1 ]);
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
            $user->load('settings','avatar','follow','messages');
            return view('profile')
                ->with('user', $user)
                ->with('tabid', $tabid);
        }
        return redirect(route('user.login'))->withErrors('Ошибка авторизации!');
    }
    public function user_info($id = 1)
    {
        $user = User::with(['settings','avatar','albums'])->findOrFail($id);
        $albums = $user->albums;
        if($albums->count()==0)
        {
            //todo: create default album
            dd(__METHOD__,$albums);
        }
        self::user_create_settings($user);
        $follows = Follow::where('user_id',$user->id)->get();
        if($follows)$follows->load('group');
        $links = [
            ['name'=>'Users','route'=>'user.users','id'=>null],
            ['name'=>$user->login,'route'=>'user.info','id'=>$user->id],
        ];
        return view('user')
            ->with('links',$links)
            ->with('user', $user)
            ->with('albums',$albums)
            ->with('follows', $follows);
    }
    public function all_users()
    {
        $users = User::with('settings')->where('id','>',0)->paginate(30);
        $links = [
            ['name'=>'Users','route'=>'user.users','id'=>null],
        ];
        if($users)
        {
            return view('users')
                ->with('links',$links)
                ->with('users', $users);
        }
        return redirect()->back()->withErrors('Users not found!');
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
        $settings = Settings::create([
            'user_id' => $user->id,
        ]);
        //dd(__METHOD__,$settings);
        if($user)
        {
            if($settings)
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
                $user->settings->muted = $muted;
            }
            if($admin)
            {
                $user->settings->admin = $admin;
            }
            //dd(__METHOD__,$user->settings);
            $user->fill($udata);
            if($pass)
            {
                $user->password = $pass;
            }
            $user->settings->save();
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
                $user->settings->status = false;
                $user->settings->smessage = '';
                $message = 'Status message deleted';
            }
            else
            {
                $user->settings->status = true;
                $user->settings->smessage = $message;
                $message = 'New status message: '.$message;
            }
            $user->settings->save();
            session()->flash('success',$message);
            return redirect()->back();
        }
        return redirect()->back()->withErrors('You don`t have permission!');
    }
    public function user_hidden($id)
    {
        $user=User::find($id);
        $hidden=$user->settings->hidden;
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
            $user->settings->hidden=$hidden;
            $user->settings->save();
            session()->flash('success',$message);
            return redirect()->back();
        }
        return redirect()->back()->withErrors('You don`t have permission!');
    }
    public function user_notifications($id)
    {
        $user=User::find($id);
        $notifications=$user->settings->notifications;
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
            $user->settings->notifications=$notifications;
            $user->settings->save();
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
            if($auth_user->id == $user->id or $auth_user->settings->admin)
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
            if(!is_null($about['interests'])){$user->settings->interests = $about['interests'];}
            if(!is_null($about['interests'])){$user->settings->about = $about['about'];}
            if(!is_null($about['interests'])){$user->settings->notes = $about['notes'];}
            $user->settings->save();
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
                $user->settings->reputation++;
                $user->settings->save();
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
                $user->settings->reputation--;
                $user->settings->save();
                session()->flash('success',"User ".$user->login." rated!");
                return redirect()->back();
            }
            return redirect()->back()->withErrors('You already rated this user!');
        }
        return redirect()->back()->withErrors('You can`t rate yourself!');
    }
    public static function user_create_settings(User $user)
    {
        $settings = $user->settings;
        if(!$settings)
        {
            Settings::create([
                'user_id' => $user->id,
            ]);
            //dd(__METHOD__,$settings);
        }
    }
    //
}
