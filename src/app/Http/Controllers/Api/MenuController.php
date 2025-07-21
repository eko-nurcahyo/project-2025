<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Menu;

/**
 * @OA\Get(
 *   path="/api/menus",
 *   summary="List semua menu",
 *   tags={"Menu"},
 *   @OA\Response(
 *     response=200,
 *     description="Success"
 *   )
 * )
 */
class MenuController extends Controller
{
    public function index()
    {
        return response()->json(Menu::all());
    }

    /**
     * @OA\Get(
     *   path="/api/menus/{id}",
     *   summary="Detail menu",
     *   tags={"Menu"},
     *   @OA\Parameter(
     *     name="id", in="path", required=true, @OA\Schema(type="integer")
     *   ),
     *   @OA\Response(response=200, description="Success")
     * )
     */
    public function show($id)
    {
        return response()->json(Menu::findOrFail($id));
    }
}
