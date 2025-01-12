<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectBasedOnRole
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            if ($request->is('admin/*') or $request->is('admin')) {
                if (!Auth::user()->isSuperAdmin()) {
                    return redirect('/web');
                }
            }else{
                if (Auth::user()->isSuperAdmin()) {
                    return redirect('/admin');
                }
            }
        }
        return $next($request);
    }
}
