<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        require_once \app_path('Support/helpers.php');

        $this->app->singleton(\App\Contracts\Services\BasketService::class, fn ($app) => $app->make(\App\Services\BasketService::class));
        $this->app->bind(\App\Contracts\Services\PaymentService::class, fn ($app) => $app->make(\App\Services\PaymentService::class));
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        \Illuminate\Pagination\Paginator::useBootstrap();
    }
}
