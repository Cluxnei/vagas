<?php

namespace App\Http\Middleware;

use Closure;

class Approved
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
        try {
            if (!auth()->user()->isApproved() && !auth()->user()->isAdministrator()) {
                auth()->logout();
                return redirect()->route('login')->with(['error' => true, 'message' => 'Sua conta ainda não foi aprovada.']);
            }
        } catch (\Throwable $th) { }
        return $next($request);
    }
}
