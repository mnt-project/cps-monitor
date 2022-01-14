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
            $visitor->basename = $location['basename'];
            $visitor->filename = $location['filename'];
            $visitor->agent = $request->userAgent();
            $visitor->save();
        }
        return $next($request);
    }
}
