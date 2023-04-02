<?php

namespace App\Services;

use Gloudemans\Shoppingcart\Facades\Cart;

class OrderService{

    public function all($request, $confirmation_number){
        $cartSubtotal = (float) Cart::instance('default')->subtotal();
        $tax = config('cart.tax')/100;
        $cartTax = $cartSubtotal * $tax;
        $code = session()->get('cupon')['name'] ?? '';
        $discount = session()->get('cupon')['discount'] ?? 0;
        $newSubtotal = ($cartSubtotal - $discount);
        $newTax = $newSubtotal * $tax;
        $newTotal = $newSubtotal * (1+$tax);

        return[
            'confirmation_number' => $confirmation_number,
            'billing_email' => $request->email,
            'billing_name' => $request->name,
            'billing_name_on_card' => $request->name_on_card,
            'billing_address' => $request->address,
            'billing_city' => $request->city,
            'billing_state' => $request->state,
            'billing_zip_code' => $request->zip_code,
            'billing_discount' => $discount,
            'billing_discount_code' => $code,
            'billing_subtotal' => $newSubtotal,
            'billing_tax' => $newTax,
            'billing_total' => $newTotal,
            'shipped' => false
        ];
    }

}