<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function checkout(Request $request) {
        $cart = session('cart', []);
        $total = collect($cart)->reduce(function($carry, $item){
            return $carry + ($item['qty'] * $item['price']);
        }, 0);

        $order = Order::create([
            'name' => $request->nama,
            'phone' => $request->nohp,
            'address' => $request->alamat,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'items' => $cart,
            'total' => $total,
        ]);
        // Hapus keranjang setelah order
        session()->forget(['cart', 'cart_count']);
        return redirect('/')->with('success', 'Order berhasil! Kami akan menghubungi Anda.');
    }
}
