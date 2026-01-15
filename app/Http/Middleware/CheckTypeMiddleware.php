<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckTypeMiddleware
{
    public function handle(Request $request, Closure $next, $type): Response
    {
        if (!auth()->check() || auth()->user()->type !== $type) {
            abort(403, 'Unauthorized action.');
        }
        return $next($request);
    }
}
