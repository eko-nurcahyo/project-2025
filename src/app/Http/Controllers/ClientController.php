<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $data = Client::all();
        return response()->json([
            'message' => 'List of clients',
            'data' => $data
        ], 200);
    }
}