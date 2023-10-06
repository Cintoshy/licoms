<?php

namespace App\Http\Middleware;

use Closure;

class DisablePageCaching
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        // Set cache control headers to disable caching
        $response->header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate');
        $response->header('Pragma', 'no-cache');
        $response->header('Expires', 'Fri, 01 Jan 1990 00:00:00 GMT');

        return $response;
    }
}
