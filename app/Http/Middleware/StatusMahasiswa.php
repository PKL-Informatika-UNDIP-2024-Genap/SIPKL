<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StatusMahasiswa
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $Status, $Status2 = ""): Response
    {
        if (auth()->user()->mahasiswa->status == $Status) {
            return $next($request);
        }
        if (auth()->user()->mahasiswa->status == $Status2) {
            return $next($request);
        }
        return redirect("/");
    }
}
