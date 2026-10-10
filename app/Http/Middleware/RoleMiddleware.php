<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        $allowedRoles = $roles;

        if (
            !$user ||
            !$user->role ||
            !in_array($user->role->value, $allowedRoles, true)
        ) {
            abort(403);
        }

        return $next($request);
    }
}