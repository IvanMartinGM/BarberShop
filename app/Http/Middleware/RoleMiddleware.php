<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    /* This middleware checks if the authenticated user has a specific role */
    public function handle(Request $request, Closure $next, string ...$role): Response
    {
        if (! $request->user()) {
            return redirect()->route('login');
        }

        if (!$request->user()->hasAnyRole([$role])) {
            return redirect()->route('home')->withErrors([
                'role' => 'No tienes permiso para acceder a esta página.',
            ]);
        }

        return $next($request);
    }
}
