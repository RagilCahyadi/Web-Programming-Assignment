<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Session::has('admin_role') || Session::get('admin_role') !== $role) {
            return redirect()->route('admin.dashboard')->with('error', 'You do not have permission to access this page');
        }

        return $next($request);
    }
}
