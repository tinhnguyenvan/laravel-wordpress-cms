<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ConsoleAuth
{
    public function handle($request, Closure $next)
    {
        if (! Auth::check()) {
            return redirect(admin_url('login'));
        }

        return $next($request);
    }
}
