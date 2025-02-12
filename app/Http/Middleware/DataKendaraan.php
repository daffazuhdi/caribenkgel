<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DataKendaraan
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $route = str_replace(url('/'), '', url()->previous());
        // return $route;

        if (! $request->expectsJson()) {
            if ($route === '/daftar' || $route === '/datakendaraan') {
                return $next($request);
            }
            elseif (Auth::guest()) {
                session()->flash('message', 'Silakan masuk ke akun terlebih dahulu.');
                return redirect('/');
            }
            else{
                session()->flash('message', 'Anda tidak punya akses ke halaman yang dituju.');
                return redirect('/');
            }
        }
    }
}
