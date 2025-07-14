<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Society;

class AuthenticateApi
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->query('token');

        if (!$token) {
            return response()->json(['message' => 'Unauthorized user'], 401);
        }

        $society = Society::where('login_tokens', $token)->first();

        if (!$society) {
            return response()->json(['message' => 'Unauthorized user'], 401);
        }

        return $next($request);
    }
}
