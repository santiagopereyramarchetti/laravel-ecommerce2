<?php

namespace App\Services;

use Gloudemans\Shoppingcart\Facades\Cart;

class CartService {

    public function setCartValues(){
        $cartItems = Cart::instance('default')->content();
        $cartTaxRate = config('cart.tax');
        $cartSubtotal = (float) Cart::instance('default')->subtotal();
        $tax = config('cart.tax')/100;
        $cartTax = $cartSubtotal * $tax;
        $code = session()->get('cupon')['name'] ?? '';
        $discount = session()->get('cupon')['discount'] ?? 0;
        $newSubtotal = ($cartSubtotal - $discount);
        $newTax = $newSubtotal * $tax;
        $newTotal = $newSubtotal * (1+$tax);
        $laterItems = Cart::instance('laterCart')->content();
        $laterCount = Cart::instance('laterCart')->count();

        return collect([
            'cartItems' => $cartItems,
            'cartTaxRate' => $cartTaxRate,
            'cartSubtotal' => $cartSubtotal,
            'tax' => $tax,
            'cartTax' => $cartTax,
            'code' => $code,
            'discount' => $discount,
            'newSubtotal' => $newSubtotal,
            'newTax' => $newTax,
            'newTotal' => $newTotal,
            'laterItems' => $laterItems,
            'laterCount' => $laterCount,
        ]);
    }

}