<?php

namespace App\Http\Middleware;

use App\Models\Cooperator;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CooperatorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $cooperatorSlug = $request->route('cooperator');

        // Validate cooperator exists
        $cooperator = Cooperator::where('slug', $cooperatorSlug)->first();

        if (!$cooperator) {
            abort(404, 'Cooperator not found');
        }

        // Store cooperator globally (e.g., session, config, etc.)
        config(['current_cooperator' => $cooperator]);
        return $next($request);
    }
}
