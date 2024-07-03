<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; // Tambahkan ini
use App\Models\Kontak;

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
    public function boot()
    {
        View::composer('sidebarnav', function ($view) {
            $kontak = Kontak::first(); // Mengambil satu data kontak, Anda bisa menyesuaikan sesuai kebutuhan
            $view->with('kontak', $kontak);
        });
    }
}
