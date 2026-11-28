<?php

namespace App\Http\Middleware;

use App\UserRole;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsActive
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user) {
            return $next($request);
        }

        $companyIsInactive = !$user->hasRole(UserRole::SYSTEM_ADMINISTRATOR)
            && (!$user->company || !$user->company->is_active);

        if (!$user->is_active || $companyIsInactive) {
            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()
                ->route('login')
                ->withErrors([
                    'email' => 'Your account or company has been deactivated.',
                ]);
        }

        return $next($request);
    }
}