<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class AdminAuthenticationMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Session::has('admin')) {
            $isAdmin = DB::table('taikhoan')
                ->where('MaTaiKhoan', Session::get('admin'))
                ->where('IsAdmin', 1)
                ->first();

            if ($isAdmin) {
                return $next($request);
            }
        }

        return redirect('/login-admin')->with('flag',0);
    }
}