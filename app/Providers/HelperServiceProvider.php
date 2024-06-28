<?php

namespace App\Providers;

use App\Helpers\Cart;
use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton('cart', function ($app) {
            return new Cart();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {

    }
}
