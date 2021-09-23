<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class BanMiddleware
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
        if ($this->isBanned($request->user())) abort(403);

        return $next($request);
    }

    function isBanned($user)
    {
        // $user->
        return false;
    }
}
