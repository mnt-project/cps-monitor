<?php

namespace App\Http\Middleware;

use App\cps\admin\Network;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConnectLog
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
        new Network($request->ip(),Auth::check() ? Auth::id() : 0,$request->userAgent(),$request->getPathInfo());
        //dd(__METHOD__,$connect->getIp());
        return $next($request);
    }
}
