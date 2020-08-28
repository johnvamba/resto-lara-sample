<?php

namespace App\Http\Middleware;

use Closure;

class AdminRoute
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(optional(auth()->user())->is_admin)
            return redirect('admin.dashboard');
        
        return $next($request);
    }
}
