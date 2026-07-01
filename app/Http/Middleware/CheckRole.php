<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if (auth()->user()->hasRole('admin')) {
            return $next($request);
        }

        if (!auth()->user()->hasAnyRole($roles)) {
            abort(403, 'Accès refusé.');
        }

        return $next($request);
    }
}
