<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $auth = Auth::guard($guard);
        if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('login_admin');
            }
        }
        if (! $auth->user()->isAdmin() && ! $auth->user()->isModerator() && ! $auth->user()->isManager()) {
            return response('Access denied.', 401);
            //return abort(503);
        }

        return $next($request);
    }
}
