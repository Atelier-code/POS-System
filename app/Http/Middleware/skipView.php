<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class skipView
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        // Get the user being viewed (assuming `user` is passed in the route parameter)
        $user = $request->route('user');

        if ($user && $user->role === 'admin') {
            // Redirect to the edit page if the user being viewed is an admin
            return redirect()->route('admin.edit.user', ['user' => $user->id]);
        }

        // Otherwise, proceed to the intended route
        return $next($request);
    }
}
