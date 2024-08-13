<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateClient
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Verifica si el cliente está autenticado usando el guard 'client'
        if (Auth::guard('client')->check()) {
            return $next($request);
        }

        // Si no está autenticado, responde con error 401 (No autorizado)
        return response()->json(['message' => 'Unauthorized'], 401);
    }
}
