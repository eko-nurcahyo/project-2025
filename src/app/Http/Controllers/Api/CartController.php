<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

/**
 * @OA\Get(
 *   path="/api/cart",
 *   summary="Lihat keranjang",
 *   tags={"Cart"},
 *   @OA\Response(response=200, description="OK")
 * )
 */
class CartController extends Controller
{
    public function index(Request $request)
    {
        $cart = session('cart', []);
        return response()->json($cart);
    }

    /**
     * @OA\Post(
     *   path="/api/cart/add",
     *   summary="Tambah menu ke keranjang",
     *   tags={"Cart"},
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *        required={"menu_id"},
     *        @OA\Property(property="menu_id", type="integer"),
     *        @OA\Property(property="qty", type="integer", default=1)
     *     )
     *   ),
     *   @OA\Response(response=200, description="OK")
     * )
     */
    public function add(Request $request)
    {
        $menu = Menu::findOrFail($request->menu_id);
        $cart = session()->get('cart', []);
        if (isset($cart[$menu->id])) {
            $cart[$menu->id]['qty'] += $request->qty ?? 1;
        } else {
            $cart[$menu->id] = [
                "name" => $menu->name,
                "qty" => $request->qty ?? 1,
                "price" => $menu->price,
                "image" => $menu->image
            ];
        }
        session(['cart' => $cart]);
        return response()->json(['message' => 'Added to cart', 'cart' => $cart]);
    }

    /**
     * @OA\Post(
     *   path="/api/cart/remove",
     *   summary="Hapus menu dari keranjang",
     *   tags={"Cart"},
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *        required={"menu_id"},
     *        @OA\Property(property="menu_id", type="integer")
     *     )
     *   ),
     *   @OA\Response(response=200, description="OK")
     * )
     */
    public function remove(Request $request)
    {
        $cart = session('cart', []);
        unset($cart[$request->menu_id]);
        session(['cart' => $cart]);
        return response()->json(['message' => 'Removed from cart', 'cart' => $cart]);
    }
}
