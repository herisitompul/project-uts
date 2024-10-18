<?php
// app/Http/Middleware/AdminMiddleware.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Pemeriksaan apakah pengguna adalah admin
        if (Auth::check() && Auth::user()->email === 'adminppw@gmail.com') {
            return $next($request);
        }

        // Jika bukan admin, mungkin hendaknya diarahkan ke halaman lain atau
        // menampilkan pesan kesalahan atau mengembalikan response yang sesuai
        return redirect('/')->withErrors(['error' => 'Unauthorized access']);
    }
}
