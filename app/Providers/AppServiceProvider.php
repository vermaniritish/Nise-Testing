<?php

namespace App\Providers;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (request()->segment(1) == 'hi') {
            App::setLocale('hi');
        } else {
            App::setLocale('en');
        }
        Paginator::defaultView('vendor.pagination.default');
    }
}
