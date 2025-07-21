<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;

// Homepage kebab
Route::get('/', function () {
    return view('frontend.index');
});

// About
Route::get('/about', function () {
    return view('frontend.about');
});

// Menu
Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');

// Book / Order
Route::get('/book', function () {
    return view('frontend.book');
});

// Cart (keranjang)
Route::get('/cart', [\App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [\App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [\App\Http\Controllers\CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [\App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');

// Checkout (form konfirmasi data diri & alamat)
Route::get('/checkout', [\App\Http\Controllers\CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout/process', [\App\Http\Controllers\CheckoutController::class, 'process'])->name('checkout.process');

// (Opsional) Payment Gateway Callback (jika pakai pembayaran otomatis)
Route::post('/payment/callback', [\App\Http\Controllers\PaymentController::class, 'callback'])->name('payment.callback');
