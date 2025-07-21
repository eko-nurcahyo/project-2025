<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PaymentController;

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
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

// Checkout (form konfirmasi data diri & alamat)
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');

// (Opsional) Payment Gateway Callback (jika pakai pembayaran otomatis)
Route::post('/payment/callback', [PaymentController::class, 'callback'])->name('payment.callback');
