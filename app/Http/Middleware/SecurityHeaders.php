<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;

class SecurityHeaders
{
   public function handle($request, Closure $next)
{
    $response = $next($request);

    if (!$request->is('admin*')) {

        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('Referrer-Policy', 'strict-origin');
    }

    return $response;
}
}