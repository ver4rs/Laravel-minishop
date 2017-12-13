<?php

namespace App\Providers;

use App\Product;
use Illuminate\Support\Facades\Validator;
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
		/**
		 * Count "size" of products
		 * @return boolean
		 */
        Validator::extend('countItem', function ($attribute, $value, $parameters, $validator) {

        	$productId = $parameters[0] ?? null;
        	$product = Product::findOrFail($productId);
        	return $product->count >= $value;
		});
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
