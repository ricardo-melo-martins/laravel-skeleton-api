<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class HeaderAuthorizationPresence
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->hasHeader('X-Authorization')) {
            return $next($request);
        }

        Log::debug('Estamos recebendo chamadas sem o cabeçalho correto');
        
        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
