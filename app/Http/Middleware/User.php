<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;
use Illuminate\Support\Facades\Log;

class User
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->is('api/*')) {
            return $next($request); // Skip middleware for API routes
        }
        // Log::info(message: 'Middleware user executed.');
        if (!Auth::guard('web')->check()) {
            return redirect()->route('login')->with('You are not authorized !');
        }
        return $next($request);
    }
}
