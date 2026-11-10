<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user() || ! $request->user()->isAdmin()) {
            if ($request->ajax()) {
                return response(json_encode(['error' => 'You are not allowed to perform this action.']), 403)
                    ->header('Content-Type', 'text/html');
            }
            return redirect()->route('dashboard');
        }

        return $next($request);
    }
}
