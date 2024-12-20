<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class checkRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // Check the user's role
            if (Auth::user()->role === $role) {
                return $next($request);
            } else {
                // Redirect based on user's role if they don't have the required role
                if (Auth::user()->role === 'admin') {
                    return redirect('/admin/dashboard');
                } else {
                    return redirect('/cashier/dashboard');
                }
            }
        }

        // Redirect if not authenticated
        return redirect('/');
    }
}
