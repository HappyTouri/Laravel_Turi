<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;


class VerifyCsrfToken
{
    /**
     * URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'api/*', // Exempt all API routes from CSRF verification
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        Log::info('Middleware csrf executed.'); // Replace with actual middleware name
        // Check if the request URI matches any in the 'except' array.
        foreach ($this->except as $except) {
            if ($request->is($except)) {
                return $next($request); // Skip CSRF check for exempted URIs
            }
        }

        // If not exempted, apply CSRF verification here (if needed)

        return $next($request); // Continue to next middleware
    }
}
