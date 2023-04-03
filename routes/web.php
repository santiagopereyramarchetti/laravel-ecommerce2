<?php

use App\Http\Controllers\Cart\CartController;
use App\Http\Controllers\Cart\LaterController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CuponController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Search\AlgoliaSearchController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

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
/* WELCOME */
Route::get('/', WelcomeController::class)->name('welcome');

/* SHOP */
Route::resource('shop', ShopController::class)->parameters(['shop' => 'product:slug'])->only(['index', 'show']);

/* CART */
Route::resource('cart', CartController::class)->parameters(['cart' => 'product'])->except(['edit', 'create']);
Route::prefix('cart/later/')->name('later.')->group(function() {
    Route::post('{product}', [LaterController::class, 'store'])->name('store');
    Route::patch('{product}', [LaterController::class, 'update'])->name('update');
    Route::delete('{product}', [LaterController::class, 'destroyLater'])->name('destroyLater');
    Route::post('move/{product}', [LaterController::class, 'moveToCart'])->name('moveToCart');
});

/* CUPON */
Route::resource('cupon', CuponController::class)->parameters(['cupon' => ''])->only(['store', 'destroy']);

/* GUEST USERS CHECKOUT */
Route::get('/guest/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/guest/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

/* AUTH USERS CHECKOUT */
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

/* ORDERS */
Route::middleware('auth:sanctum', 'verified')->group(function() {
    Route::get('dashboard', DashboardController::class)->name('dashboard');
    Route::get('my-orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('my-orders/invoice/{order:confirmation_number}', [OrderController::class, 'show'])->name('orders.show');
    Route::resource('invoice', InvoiceController::class)->parameters(['invoice' => 'order:confirmation_number'])->only(['show', 'store']);
});

/* SEARCHS */
Route::get('/search-algolia', [AlgoliaSearchController::class, 'index'])->name('searchAlgolia.index');