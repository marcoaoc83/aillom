<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RestrictAdminAccess
{
    public function handle(Request $request, Closure $next): Response
    {
        // Verifique se o usuário está autenticado
        if (Auth::check()) {
            // Bloqueia acesso se o usuário não for superadmin
            if (!Auth::user()->isSuperAdmin()) {
                return redirect('/web');
            }
        }

        return $next($request);
    }
}
