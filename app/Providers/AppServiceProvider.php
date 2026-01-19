<?php

namespace App\Providers;

use App\Models\GudangKeluar;
use App\Models\GudangMasuk;
use App\Observers\GudangKeluarObserver;
use App\Observers\GudangMasukObserver;
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
        GudangMasuk::observe(GudangMasukObserver::class);
        GudangKeluar::observe(GudangKeluarObserver::class);
    }
}
