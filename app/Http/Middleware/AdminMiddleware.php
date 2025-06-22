<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->is_admin) {
            return $next($request);
        }

        // Thêm log chi tiết
        \Log::error('Admin access denied', [
            'user_id' => Auth::id(),
            'is_admin' => Auth::check() ? Auth::user()->is_admin : false,
            'route' => $request->route()->getName(),
            'ip' => $request->ip()
        ]);

        abort(403, 'This action is unauthorized.');
    }
}