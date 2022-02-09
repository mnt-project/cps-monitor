<?php

namespace App\Http\Middleware;

use App\Models\JournalConnections;
use Closure;
use Illuminate\Http\Request;

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
        $location = pathinfo($request->path());
        $visitor = new JournalConnections();
        if($visitor)
        {
            $visitor->visitor = $request->ip();;
            $visitor->status = 1;
            $visitor->dirname = $location['dirname'];
            $visitor->basename = mb_substr($location['basename'],0,32);
            $visitor->filename = mb_substr($location['filename'],0,32);
            $visitor->agent = $request->userAgent();
            $visitor->save();
        }
        return $next($request);
    }
}
