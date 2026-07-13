<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRol
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        if (!$user || !$user->colaborador) {
            return response()->json(['message' => 'No autorizado'], 403);
        }

        $rolesUsuario = $user->colaborador->roles->pluck('slug')->toArray();

        foreach ($roles as $rol) {
            if (in_array($rol, $rolesUsuario)) {
                return $next($request);
            }
        }

        return response()->json(['message' => 'No tienes permisos para esta acción'], 403);
    }
}
