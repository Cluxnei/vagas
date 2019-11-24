<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Throwable;

class Approved
{
    private function loginAndMessage($error = true, $message = 'Sua conta ainda não foi aprovada.')
    {
        auth()->logout();
        return redirect()->route('login')->with(['error' => $error, 'message' => $message]);
    }
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $user = auth()->user();
            if ($user->isFirstLogin()) {
                $user->unsetFirstLogin();
                return $this->loginAndMessage(false, 'Seu cadastro foi efetuado com sucesso, aguarde aprovação de nossos administradores.');
            }
            if (!$user->isApproved() && !$user->isAdministrator()) {
                return $this->loginAndMessage();
            }
        } catch (Throwable $th) { }
        return $next($request);
    }
}
