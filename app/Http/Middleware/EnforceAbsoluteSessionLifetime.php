<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnforceAbsoluteSessionLifetime
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::guard('web')->check()) {
            return $next($request);
        }

        $session = $request->session();

        $now = now()->timestamp;

        // Absolute session start time
        $startedAt = $session->get('auth.absolute_started_at');

        if (!$startedAt) {
            $startedAt = $now;
            $session->put('auth.absolute_started_at', $startedAt);
        }

        // Last authenticated activity time
        $lastActivityAt = $session->get('auth.last_activity_at', $startedAt);

        $absoluteLifetime = (int) config('session.absolute_lifetime', 480);
        $idleLifetime = (int) config('session.lifetime', 30);

        $absoluteExpired =
            ($now - (int) $startedAt) >= ($absoluteLifetime * 60);

        $idleExpired =
            ($now - (int) $lastActivityAt) >= ($idleLifetime * 60);

        // Logout if either limit has expired
        if ($absoluteExpired || $idleExpired) {

            Auth::guard('web')->logout();

            $session->invalidate();
            $session->regenerateToken();

            return redirect()
                ->route('login')
                ->with('status', 'Your session has expired. Please log in again.');
        }

        // Update activity only after both checks pass
        $session->put('auth.last_activity_at', $now);

        return $next($request);
    }
}
