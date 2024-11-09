<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!$request->user() || !$request->user()->roles()->whereIn('name', $roles)->exists()) {
            if ($request->inertia()){
                return redirect()->route('dashboard')->with('error', 'You are not authorized to access this page');
            }
            abort(403, 'Unauthorized action');
        }
        return $next($request);
    }
}
