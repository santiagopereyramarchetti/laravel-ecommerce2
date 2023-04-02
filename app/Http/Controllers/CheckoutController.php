<?php

namespace App\Http\Controllers;

use App\Contracts\PaymentGatewayContract;
use App\Http\Requests\CheckoutFormRequest;
use App\Mail\OrderRecived;
use App\Models\Product;
use App\Models\User;
use App\Services\CartService;
use App\Services\InvoiceService;
use App\Services\OrderService;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;
use Stripe\Exception\CardException;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{

    

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $content = [
            'cartItems' => $this->cartService->setCartValues()->get('cartItems'),
            'cartTaxRate' => $this->cartService->setCartValues()->get('cartTaxRate'),
            'cartSubtotal' => $this->cartService->setCartValues()->get('cartSubtotal'),
            'newTax' => $this->cartService->setCartValues()->get('newTax'),
            'code' =>$this->cartService->setCartValues()->get('code'),
            'discount' => $this->cartService->setCartValues()->get('discount'),
            'newSubtotal' => $this->cartService->setCartValues()->get('newSubtotal'),
            'newTotal' => $this->cartService->setCartValues()->get('newTotal'),
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

    public function store(PaymentGatewayContract $paymentService, OrderService $orderService, CheckoutFormRequest $request, InvoiceService $invoiceService)
    {
        try{
            
            $confirmation_number = Str::uuid();
            $user = auth()->user() ?? new User;

            $paymentService->charge($user, $request, $confirmation_number);
            $order = $user->orders()->create($orderService->all($request, $confirmation_number));

            foreach(Cart::instance('default')->content() as $item){
                $product = Product::find($item->model->id);
                if($product->quantity < $item->qty){
                    if($product->quantity === 0){
                        return response([
                            'errors' => 'Sorry ' . $item->name . ' is no longer available. Please remove the item from yor cart'
                        ], 400);
                    }
                    return response([
                        'errors' => 'Sorrt! there are only ' . $product->quantity . ' of ' . $item->name . ' left. Please adjust the quantities in your cart'
                    ]);
                }
                $order->products()->attach($product, ['quantity' => $item->qty]);
                $product->decrement('quantity', $item->qty);
            }
            
            Cart::instance('default')->destroy();
            if(session()->has('cupon')){
                session()->forget('cupon');
            }

            $userInvoice = auth()->user() ?? $order->billing_email;

            Mail::to($userInvoice)->send(new OrderRecived($order->load('products'), $invoiceService->createInvoice($order)));

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
