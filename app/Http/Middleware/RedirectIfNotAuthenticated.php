<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotAuthenticated
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
        // Check if the app is in 'local' environment and the user is not authenticated
        if (app()->environment('local') && !Auth::check()) {
            // Redirect to login page
            return redirect()->route('login');
        }

        return $next($request);
    }
}

