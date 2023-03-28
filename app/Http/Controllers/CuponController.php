<?php

namespace App\Http\Controllers;

use App\Models\Cupons\Cupon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CuponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $cuponCode = Cupon::findByCode($request->cupon_code);
        if(!$cuponCode){
            return back()->withErrors(['message' => 'We could not find your cupon. Please try again']);
        }
        $cupon = $cuponCode->cuponable;
        $subtotal = Cart::instance('default')->subtotal();
        $discount = $cupon->discount($subtotal);
        session()->put('cupon', [
            'name' => $cuponCode->code,
            'discount' => $discount
        ]);
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Cupon $cupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cupon $cupon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cupon $cupon)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cupon $cupon)
    {
        session()->forget('cupon');
        return back();
    }
}
