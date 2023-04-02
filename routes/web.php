<?php

use App\Http\Controllers\Cart\CartController;
use App\Http\Controllers\Cart\LaterController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CuponController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

/* SHOP */

Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/shop/{product:slug}', [ShopController::class, 'show'])->name('shop.show');

/* CART */
Route::get('cart', [CartController::class, 'index'])->name('cart.index');
Route::post('store', [CartController::class, 'store'])->name('cart.store');
Route::patch('store/{product}', [CartController::class, 'update'])->name('cart.update');
Route::post('cart/later/{product}', [LaterController::class, 'store'])->name('later.store');
Route::patch('cart/later/{product}', [LaterController::class, 'update'])->name('later.update');
Route::post('cart/move/{product}', [LaterController::class, 'moveToCart'])->name('later.moveToCart');
Route::delete('cart/{product}', [LaterController::class, 'destroy'])->name('later.destroy');
Route::delete('cart/later/{product}', [LaterController::class, 'destroyLater'])->name('later.destroyLater');


/* CUPON */
Route::post('/cupon', [CuponController::class, 'store'])->name('cupon.store');
Route::delete('/cupon', [CuponController::class, 'destroy'])->name('cupon.destroy');

/* GUEST USERS CHECKOUT */
Route::get('/guest/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/guest/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

/* AUTH USERS CHECKOUT */
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

/* ORDERS */

Route::middleware('auth:sanctum', 'verified')->group(function() {
    Route::get('my-orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('my-orders/invoice/{order:confirmation_number}', [OrderController::class, 'show'])->name('orders.show');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});
