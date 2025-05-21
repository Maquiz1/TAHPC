<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;

class PreventBackButton
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        // Check if the response is an instance of RedirectResponse
        if ($response instanceof \Illuminate\Http\RedirectResponse) {
            return $response;
        }

        // Check if the response is an instance of BinaryFileResponse
        if ($response instanceof BinaryFileResponse) {
            return $response;
        }

        // Apply headers for other types of responses (e.g., Illuminate\Http\Response)
        return $response->header('Cache-Control', 'nocache, no-store, max-age=0, must-revalidate')->header('Pragma', 'no-cache')->header('Expires', 'Sat, 26 Jul 1997 05:00:00 GMT');
    }
}
