<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $cartItems = Cart::instance('default')->content();
        $cartTaxRate = config('cart.tax');
        $cartSubtotal = (float) Cart::instance('default')->subtotal();
        $tax = config('cart.tax')/100;
        $cartTax = $cartSubtotal * $tax;
        $newTotal = (float) Cart::instance('default')->total();
        $laterItems = Cart::instance('laterCart')->content();
        $laterCount = Cart::instance('laterCart')->count();
        return Inertia::render('Cart/Index', compact('cartItems', 'cartTaxRate', 'cartSubtotal', 'cartTax', 'newTotal', 'laterItems', 'laterCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        Cart::instance('default')->add($request->id, $request->name, $request->quantity, $request->price, 0, ['totalQty' => $request->totalQty, 'product_code' => $request->product_code, 'image' => $request->image, 'slug' => $request->slug, 'details' => $request->details])->associate('App\Models\Product');
        return redirect()->route('cart.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Cart::instance('default')->update($id, $request->quantity);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
