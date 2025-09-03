<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle($request, Closure $next, ...$roles)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $userRole = strtolower(auth()->user()->role);
        $rolesArray = array_map('strtolower', $roles);

        if (!in_array($userRole, $rolesArray)) {
            abort(403, 'Acceso no autorizado.');
        }

        return $next($request);
    }
}