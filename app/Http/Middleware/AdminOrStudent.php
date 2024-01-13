<?php

namespace App\Http\Middleware;

use App\Helper\AuthMiddleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminOrStudent
{
    /**
     * Handle an incoming request.
     *
     * @param   \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     * 
     */
    public function handle(Request $request, Closure $next): Response
    {
        /*
           1- Student
           2- Collector
           3- Admin
        */
        return AuthMiddleware::checkRoles(Auth::user()->role_id, [1, 3]) ? $next($request) : redirect('/login');
    }
}
