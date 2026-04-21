<?php

namespace App\Providers;

use App\Models\PenjualanDetail; // Import Model
use App\Observers\PenjualanDetailObserver; // Import Observer
use Illuminate\Support\ServiceProvider;

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
        /** * DAFTARKAN OBSERVER DI SINI
         * Ini akan memerintahkan Laravel untuk menjalankan logika di 
         * PenjualanDetailObserver setiap kali ada aksi pada model PenjualanDetail.
         */
        PenjualanDetail::observe(PenjualanDetailObserver::class);
    }
}