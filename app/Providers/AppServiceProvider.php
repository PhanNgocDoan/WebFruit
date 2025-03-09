<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        $logos = DB::table('album')->where('Loai', 'logo')->select('*')->get();
        $loaitcs = DB::table('loaitraicay')->select('*')->get();
        $loaigqs= DB::table('loaigioqua')->select('*')->get();
        View::composer(['baiviet.tintuc', 'gioqua.gioqua_ct', 'baiviet.ct_gioithieu','gioqua.gioqua', 'shop.shop','detail.detail', 'baiviet.ct_tintuc','contact.lienhe','auth.login'], function ($view) use ($logos, $loaitcs,$loaigqs) {
            $view->with('logos', $logos)->with('loaitcs', $loaitcs)->with('loaigqs', $loaigqs);
        });
    }
}