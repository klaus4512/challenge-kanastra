<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind(
            \App\Repositories\BilletFileRepository::class,
            \App\Repositories\BilletFileLocalRepository::class
        );

        $this->app->bind(
            \App\Repositories\BilletRepository::class,
            \App\Repositories\BilletEloquentRepository::class
        );

        $this->app->bind(
            \App\Services\Interfaces\BilletMailService::class,
            \App\Services\LogBilletMailService::class
        );

        $this->app->bind(
            \App\Services\Interfaces\BilletPDFGeneratorService::class,
            \App\Services\LogBilletPDFGeneratorService::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
