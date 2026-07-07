<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RolMiddleware
{
    public function handle(
        Request $request,
        Closure $next,
        ...$roles
    ): Response {

        if (!auth()->check()) {

            return redirect('/login');
        }

        foreach ($roles as $rol) {

            if (
                auth()->user()->tieneRol($rol)
            ) {

                return $next($request);
            }
        }

        return abort(403);
    }
}