<?php

namespace App\Src\Cart;


use Illuminate\Support\ServiceProvider;

class CartServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('cart', function ($app) {
            return new ShoppingCart($app->make('request'));
        });
    }

}