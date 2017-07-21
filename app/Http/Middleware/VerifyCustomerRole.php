<?php

namespace WTG\Http\Middleware;

use Closure;

class VerifyCustomerRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (auth()->guest()) {
            return back();
        }

        if (auth()->hasRole($role)) {
            return $next($request);
        }

        return back()
            ->withErrors(trans('auth.insufficientPermission'));
    }
}
