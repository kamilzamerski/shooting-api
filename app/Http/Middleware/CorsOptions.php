<?php

namespace App\Http\Middleware;

use Closure;

class CorsOptions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return $next($request)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET, PUT, POST, DELETE')
            ->header('Access-Control-Allow-Headers', 'Accept, Content-Type,X-CSRF-TOKEN')
            ->header('Access-Control-Allow-Credentials', 'true');
    }
}
