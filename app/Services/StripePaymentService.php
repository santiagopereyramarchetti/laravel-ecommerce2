<?php

namespace App\Services;

use App\Contracts\PaymentGatewayContract;
use Gloudemans\Shoppingcart\Facades\Cart;

class StripePaymentService implements PaymentGatewayContract{

    private $cartItems;

    public function __construct($cartItems)
    {
        $this->cartItems = $cartItems;
    }

    public function charge($user, $request, $confirmation_number){
        if(session()->has('cupon')){
            $discountValue = session()->get('cupon')['discount']/100;
            $discountCode = session()->get('cupon')['name'];
        }else{
            $discountValue = 0;
            $discountCode = 'NULL';
        }

        $payment = $user->charge(ceil($request->amount), $request->payment_method_id, [
            'receipt_email' => $request->email,
            'statement_descriptor' => 'Santiago Shops',
            'description' => 'You bought my swag!',
            'metadata' => [
                'Confirmation # ' => $confirmation_number,
                'Item(s)' => $this->cartItems,
                'Total Item(s) Count' => Cart::instance('default')->count(),
                'Discount' => $discountCode.': -$'.$discountValue.' off',
            ]
        ]);
        $payment = $payment->asStripePaymentIntent();
    }

}