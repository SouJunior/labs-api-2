<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    /**
     * Manipula a requisição para verificar a permissão do usuário.
     */
    public function handle(Request $request, Closure $next, $requiredPermission)
    {
        $user = Auth::user();

        if (!$user || !$user->hasPermission($requiredPermission)) {
            return response()->json(['message' => 'Acesso negado. Permissão insuficiente.'], 403);
        }

        return $next($request);
    }
}
