<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\OrderController;

// ----------------- MENU API -----------------
// GET /api/menus       -> List all menu items
// GET /api/menus/{id}  -> Show detail menu item
Route::get('menus', [MenuController::class, 'index']);
Route::get('menus/{id}', [MenuController::class, 'show']);

// ----------------- CART API -----------------
// GET /api/cart        -> List items in cart (by session/token/user)
// POST /api/cart/add   -> Add item to cart
// POST /api/cart/remove-> Remove item from cart
Route::get('cart', [CartController::class, 'index']);
Route::post('cart/add', [CartController::class, 'add']);
Route::post('cart/remove', [CartController::class, 'remove']);

// ----------------- ORDER API -----------------
// POST /api/orders     -> Place new order
// GET /api/orders      -> List all orders (or order history)
Route::post('orders', [OrderController::class, 'store']);
Route::get('orders', [OrderController::class, 'index']);
