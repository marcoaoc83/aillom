<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectBasedOnRole
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            // Verifique se o usuário é superadmin
            if (Auth::user()->isSuperAdmin()) {
                return redirect('/admin');
            }

            // Caso contrário, redirecione para /web
            return redirect('/web');
        }
        return redirect('/web');
        return $next($request);
    }
}
