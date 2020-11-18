<?php

namespace App\Http\Middleware;

use App\Models\RolePermission;
use Closure;
use Illuminate\Support\Facades\Auth;

class ConsoleAuth
{
    public function handle($request, Closure $next)
    {
        if (!Auth::guard(RolePermission::GUARD_NAME_ADMIN)->check()) {
            return redirect(admin_url('login'));
        }

        return $next($request);
    }
}
