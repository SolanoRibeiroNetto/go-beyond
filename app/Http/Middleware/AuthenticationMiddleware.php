<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthenticationMiddleware
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
        //TODO:: se o token que tiver o nome authorization tiver o valor diferente de #*Q<Q?=HHU)S]X/, teremos um erro 401. negado.

        if ($request->header('Authorization') !== '#*Q<Q?=HHU)S]X/') {
            return Response([
                'status' => 401,
                'msg' => 'Acesso não autorizado, token obrigatório.'
            ],
            401);
        }

        return $next($request);
    }
}
