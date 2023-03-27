<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class LaterController extends Controller
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
    public function store($id)
    {
        $item = Cart::instance('default')->get($id);
        Cart::instance('default')->remove($id);
        Cart::instance('laterCart')->add(
                                        $item->id, 
                                        $item->name, 
                                        $item->qty, 
                                        $item->price, 
                                        0, 
                                        ['totalQty' => $item->options->totalQty,
                                         'product_code' => $item->options->product_code,
                                         'image' => $item->options->image,
                                         'slug' => $item->options->slug,
                                         'details' => $item->options->details
                                        ])->associate('App\Models\Product');
        return back();
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
        Cart::instance('laterCart')->update($id, $request->quantity);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Cart::instance('default')->remove($id);
        return back();
    }

    public function moveToCart($id)
    {
        $item = Cart::instance('laterCart')->get($id);
        Cart::instance('laterCart')->remove($id);
        Cart::instance('default')->add(
                                        $item->id, 
                                        $item->name, 
                                        $item->qty, 
                                        $item->price, 
                                        0, 
                                        ['totalQty' => $item->options->totalQty,
                                         'product_code' => $item->options->product_code,
                                         'image' => $item->options->image,
                                         'slug' => $item->options->slug,
                                         'details' => $item->options->details
                                        ])->associate('App\Models\Product');
        return back();
    }

    public function destroyLater($id)
    {
        Cart::instance('laterCart')->remove($id);
        return back();
    }
}
