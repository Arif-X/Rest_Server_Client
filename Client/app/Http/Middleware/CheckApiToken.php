<?php

namespace App\Http\Middleware;

use Closure;

class CheckApiToken
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
        if (session()->has('user')) {
            $user = session()->get('user');
            if (!empty($user['access_token'])) {
                return $next($request);
            }
        }

        return redirect('/login')->with('message', 'Anda harus login terlebih dahulu');
    }
}
