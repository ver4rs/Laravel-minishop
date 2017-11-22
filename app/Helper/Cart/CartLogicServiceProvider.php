<?php

namespace App\Helper\Cart;

use Illuminate\Support\ServiceProvider;

class CartLogicServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('cartLogic', function ($app) {
           return new CartLogic();
        });
    }
}
