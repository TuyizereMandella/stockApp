<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Check if admin is authenticated, redirect to login if not
        if (!Auth::guard('admin')->check()) {
            return redirect('/login');
        }
        return $next($request);
    }
}