<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\uLoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class uLoginController extends Controller
{
    //
    public function user_login(uLoginRequest $req)
    {
        $rember = $req->get('remember');
        if($rember)$rember=true;
        else $rember=false;
        $data = $req->only(['email','password']);
        if(Auth::attempt($data,$rember))
        {
            $user = Auth::user()->id;
            return redirect()->intended(route('user.profile',$user));
        }
        else return redirect(route('user.login'))->withErrors('Неправильный пароль!');
    }
    public function user_logout()
    {

    }
    public function getUserInfo(uLoginRequest $req)
    {
        dd($req);
    }
    public function user_registration(Request $request)
    {
        if(Auth::check())
        {
            return redirect(route('user.profile'));
        }
        //$user=User::create($request);
        $data = $request->only(['login','email','age','password']);
        $user = User::create($data);

        if($user)
        {
            Auth::login($user);
            return redirect(route('user.profile',$user));
        }
        return redirect(route('user.login'))->withErrors(['saveError' => 'Save error!']);
    }
}
