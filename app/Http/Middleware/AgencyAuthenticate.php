<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class AgencyAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!Auth::guard('agency')->check()){
            return redirect()->route('agency.login');
        }
        return $next($request);
    }
}
