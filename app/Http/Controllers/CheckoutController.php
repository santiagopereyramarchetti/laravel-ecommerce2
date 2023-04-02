<?php

namespace App\Http\Controllers;

use App\Contracts\PaymentGatewayContract;
use App\Http\Requests\CheckoutFormRequest;
use App\Models\Product;
use App\Models\User;
use App\Services\CartService;
use App\Services\OrderService;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Stripe\Exception\CardException;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CartService $cartService)
    {

        $content = [
            'cartItems' => $cartService->setCartValues()->get('cartItems'),
            'cartTaxRate' => $cartService->setCartValues()->get('cartTaxRate'),
            'cartSubtotal' => $cartService->setCartValues()->get('cartSubtotal'),
            'newTax' => $cartService->setCartValues()->get('newTax'),
            'code' =>$cartService->setCartValues()->get('code'),
            'discount' => $cartService->setCartValues()->get('discount'),
            'newSubtotal' => $cartService->setCartValues()->get('newSubtotal'),
            'newTotal' => $cartService->setCartValues()->get('newTotal'),
        ];

        if(Cart::instance('default')->count() == 0){
            return redirect()->route('shop.index');
        }

        if(!auth()->check()){
            return Inertia::render('Checkout/Guest', $content);
        }

        return Inertia::render('Checkout/Index', $content);
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

    public function store(PaymentGatewayContract $paymentService, OrderService $orderService, CheckoutFormRequest $request)
    {
        try{
            
            $confirmation_number = Str::uuid();
            $user = auth()->user() ?? new User;

            $paymentService->charge($user, $request, $confirmation_number);
            $order = $user->orders()->create($orderService->all($request, $confirmation_number));

            foreach(Cart::instance('default')->content() as $item){
                $product = Product::find($item->model->id);
                $order->products()->attach($product, ['quantity' => $item->qty]);
            }
            
            return response([
                'success' => true,
                'order' => [
                    'confirmation_number' => $order->confirmation_number,
                    'billing_subtotal' => $order->billing_subtotal,
                    'billing_tax' => $order->billing_tax,
                    'billing_discount_code' => $order->billing_discount_code,
                    'billing_discount' => $order->billing_discount,
                    'billing_total' => $order->billing_total,
                    'items' => $order->products,
                ]
            ], 200);
        }catch(CardException $e){
            return response([
                'errors' => $e->getMessage()
            ],500);
        }catch(\Error $e){
            return response([
                'errors' => $e->getMessage()
            ],500);
        }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
