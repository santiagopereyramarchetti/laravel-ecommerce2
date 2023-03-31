<?php

namespace App\Providers;

use App\Contracts\PaymentGatewayContract;
use App\Services\StripePaymentService;
use Gloudemans\Shoppingcart\Facades\Cart;
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
        $this->app->scoped(PaymentGatewayContract::class, function($app){
            $cartItems = Cart::instance('default')->content()->map(function($item) {
                return 'Product Code: '.$item->options->product_code.', '.
                        'Product Name: '.$item->model->name.', '.
                        'Product Qty: '.$item->qty
                ;
            })->values()->toJson();
            return new StripePaymentService($cartItems);
        });
    }
}
