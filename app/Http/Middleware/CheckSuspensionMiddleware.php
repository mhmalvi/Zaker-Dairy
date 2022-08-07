<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckSuspensionMiddleware
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
        /**
         * check if user is suspended
         * if yes, then logout the user and redirect to login page
         */
        if (auth()->check() && auth()->user()->is_suspended == 'yes') {
            auth()->logout();
            return redirect('/login')->withErrors([
                'errors' => [
                    'Your account is suspended. Please contact our support team.'
                ]
            ]);
        }

        return $next($request);
    }
}
