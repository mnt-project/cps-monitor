<?php

namespace App\Http\Middleware;

use App\cps\admin\Network;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Connect
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $connect=new Network($request->ip(),Auth::check() ? Auth::id() : 0,$request->userAgent(),$request->getPathInfo());
        if($connect->getIpBan())abort(403, 'You IP address baned!');
        return $next($request);
    }
}
