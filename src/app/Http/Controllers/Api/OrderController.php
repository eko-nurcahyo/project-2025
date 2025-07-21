<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

/**
 * @OA\Post(
 *   path="/api/orders",
 *   summary="Buat pesanan",
 *   tags={"Order"},
 *   @OA\RequestBody(
 *     required=true,
 *     @OA\JsonContent(
 *        required={"name","phone","address","latitude","longitude","items","total"},
 *        @OA\Property(property="name", type="string"),
 *        @OA\Property(property="phone", type="string"),
 *        @OA\Property(property="address", type="string"),
 *        @OA\Property(property="latitude", type="number", format="float"),
 *        @OA\Property(property="longitude", type="number", format="float"),
 *        @OA\Property(property="items", type="array", @OA\Items(type="object")),
 *        @OA\Property(property="total", type="number", format="float"),
 *     )
 *   ),
 *   @OA\Response(response=201, description="Created")
 * )
 */
class OrderController extends Controller
{
    public function store(Request $request)
    {
        $order = Order::create($request->all());
        // Kosongkan session cart jika perlu
        session()->forget('cart');
        return response()->json($order, 201);
    }

    /**
     * @OA\Get(
     *   path="/api/orders",
     *   summary="List semua pesanan",
     *   tags={"Order"},
     *   @OA\Response(response=200, description="Success")
     * )
     */
    public function index()
    {
        return response()->json(Order::latest()->get());
    }
}
