<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAccountType
{
    /**
     * Handle an incoming request.
     *
     * Usage: ->middleware(['auth', 'account_type:user'])
     */
    public function handle(Request $request, Closure $next, string $requiredType): Response
    {
        $user = $request->user();

        if (! $user) {
            return redirect()->route('login');
        }

        // Allow admins to access only admin area; for others, must match exactly
        if ($requiredType === 'admin') {
            if (($user->account_type ?? 'user') !== 'admin') {
                abort(403, 'Unauthorized');
            }
        } else {
            if (($user->account_type ?? 'user') !== $requiredType) {
                abort(403, 'Unauthorized');
            }
        }

        return $next($request);
    }
}