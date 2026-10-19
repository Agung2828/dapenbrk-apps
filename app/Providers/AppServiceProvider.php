<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\WbsLaporan;

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
        View::composer('adminwbs.*', function ($view) {
            if (Auth::guard('adminwbs')->check()) {
                $view->with('notifCount', WbsLaporan::where('status', 'diajukan')->count());
                $view->with('notifLatest', WbsLaporan::where('status', 'diajukan')->latest()->take(5)->get());
            } else {
                $view->with('notifCount', 0);
                $view->with('notifLatest', collect());
            }
        });
    }
}
