<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FreshGraduateMiddleware
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
        // Periksa apakah user sudah login
        if (auth()->check()) {
            $user = auth()->user();

            // Cek apakah user adalah fresh graduate
            if ($user->graduation_date && Carbon::parse($user->graduation_date)->diffInYears(now()) <= 1) {
                // Lanjutkan request jika user adalah fresh graduate
                return $next($request);
            } else {
                // Jika bukan fresh graduate, arahkan ke halaman lain
                return redirect()->route('home')->with('error', 'Anda tidak memiliki akses ke lowongan pekerjaan terbaru.');
            }
        }

        // Jika tidak login, arahkan ke halaman login
        return redirect()->route('login');
    }
}
