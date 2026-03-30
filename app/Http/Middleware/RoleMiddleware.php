<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        if (isset($user->role) && $user->role === $role) {
            return $next($request);
        }

        if ($user->role === 'admin') {
            return redirect()->route('admin.home')->with('error', 'You cannot access that page as admin.');
        }

        return redirect()->route('home')->with('error', 'You have no access to that page.');
    }
}
