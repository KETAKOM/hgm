<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Hospotal
        $this->app->bind(
            \App\Repositories\Hospital\HospitalRepositoryInterface::class,
            \App\Repositories\Hospital\HospitalRepository::class
        );
    }
}
