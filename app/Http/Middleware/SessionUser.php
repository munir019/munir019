<?php

namespace App\Http\Middleware;

use App\Orangebd\Network;
use Auth;
use Closure;

class SessionUser
{
    use Network;
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function handle($request, Closure $next)
    {
        if(session()->has("user")) {
            return $next($request);
        }
        //return abort(404);
        return  redirect(config('app.url').'login');
    }
}
