<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

class Permission
{
    /**
     * @var Illuminate\Contracts\Auth\Guard
     */
    protected $auth;

    /**
     * Create a new UserHasPermission instance.
     *
     * @param Guard $auth
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($this->auth->check()) {
            if (!\General::getGuest()) {
                if (! \General::is_allow(Route::currentRouteName(), $this->auth->user()->id)) {
                    if ($request->ajax()) {
                        return response('Unauthorized.', 401);
                    }else{
                        App::abort(401, 'Unauthorized');
                    }
                }
            }else{
               dd("It didn't come to anything");
            }
        } else {
            if ($this->auth->guest()) {
                if (!\General::is_allow(Route::currentRouteName(), $this->auth->user()->id)) {
                    if ($request->ajax()) {
                        return response('Unauthorized.', 403);
                    }
                    abort(403, 'Unauthorized action.');
                }
            }
        } 
        return $next($request);
    }
}
