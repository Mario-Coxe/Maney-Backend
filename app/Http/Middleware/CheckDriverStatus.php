<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckDriverStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
       // var_dump($request->user()); exit;
        // Verifique se o usuário é um motorista ativo
          // Verificar o token de autenticação do motorista
          $user = $request->user(); // Obtém o objeto do usuário autenticado

    if ($request->bearerToken()) {
        if (!$request->user()->isDriverActive()) {
            return response()->json(['message' => 'Motorista inativo'], 403);
        }else{
            $user->update(['ultima_atividade' => now()]);

        }
    }
        return $next($request);
    }
}
