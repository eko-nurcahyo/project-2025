<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order; // <-- pakai jika ingin simpan order ke DB

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        return view('frontend.checkout', compact('cart'));
    }

    public function process(Request $request)
    {
        // Jika request Google Pay
        if ($request->has('paymentData')) {
            $paymentData = $request->input('paymentData');
            // Contoh log
            \Log::info('Google Pay Data:', ['paymentData' => $paymentData]);

            // Simpan order jika mau (opsional)
            Order::create([
                 'name' => $paymentData['name'] ?? '',
                 'phone' => $paymentData['phone'] ?? '',
                 'address' => $paymentData['address'] ?? '',
                 'items' => json_encode(session('cart', [])),
                 'total' => $paymentData['total'] ?? 0,
             ]);

            session()->forget('cart');
            session()->forget('cart_count');

            return response()->json(['success' => true, 'message' => 'Pembayaran Google Pay diterima!']);
        } else {
            // Request dari form biasa
            $request->validate([
                'nama' => 'required',
                'phone' => 'required',
                'alamat' => 'required',
            ]);

            // Simpan order ke database (opsional)
             Order::create([
                 'name' => $request->nama,
                 'phone' => $request->phone,
                 'address' => $request->alamat,
                 'items' => json_encode(session('cart', [])),
                 'total' => collect(session('cart', []))->sum(function($i){ return $i['qty'] * $i['price']; }),
             ]);

            session()->forget('cart');
            session()->forget('cart_count');

            return redirect('/')->with('success', 'Pesanan Anda berhasil diproses!');
        }
    }
}
