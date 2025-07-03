<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CorsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Define os cabeçalhos CORS
        return $next($request)
            ->header('Access-Control-Allow-Origin', 'http://localhost:3000') // URL do seu frontend React
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS') // Permite métodos
            ->header('Access-Control-Allow-Headers', 'Content-Type, X-Requested-With, X-CSRF-TOKEN, Authorization') // Permite cabeçalhos incluindo Authorization
            ->header('Access-Control-Allow-Credentials', 'true');
    }
}
