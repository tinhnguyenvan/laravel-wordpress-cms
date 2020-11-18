<?php

namespace App\Http\Middleware;

use App\Models\RolePermission;
use Closure;
use Illuminate\Support\Facades\Auth;

class WebAuth
{
    public function handle($request, Closure $next)
    {
        if (!Auth::guard(RolePermission::GUARD_NAME_WEB)->check()) {
            return redirect(base_url('member/login'));
        }

        return $next($request);
    }
}
