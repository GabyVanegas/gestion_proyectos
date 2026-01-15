<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verificamos si el usuario está logueado y si su rol es 'Admin'
        if (\Illuminate\Support\Facades\Auth::check() && $request->user()->role && $request->user()->role->name === 'Admin') {
        return $next($request);
        }

        // Si no es admin, lo mandamos al home con un error
        return redirect('/home')->with('error', 'No tienes permisos de administrador.');
    }
}
