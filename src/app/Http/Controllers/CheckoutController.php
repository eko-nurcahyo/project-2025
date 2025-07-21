<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Menu; // Ganti Product jadi Menu
use Midtrans\Config;
use Midtrans\Snap;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        return view('frontend.checkout', compact('cart'));
    }

    public function process(Request $request)
    {
        $cart = session('cart', []);
        if (empty($cart)) {
            return back()->with('error', 'Keranjang belanja kosong!');
        }

        $menuIds = array_keys($cart);
        $menus = Menu::whereIn('id', $menuIds)->get()->keyBy('id');

        $total = 0;
        $items = [];

        foreach ($cart as $menu_id => $item) {
            $menu = $menus->get($menu_id);
            if (!$menu) continue;

            $qty = $item['qty'] ?? 1;
            $price = $menu->price;
            $subtotal = $price * $qty;

            $total += $subtotal;
            $items[] = [
                'menu_id'   => $menu->id,
                'menu_name' => $menu->name,
                'price'     => $price,
                'qty'       => $qty,
                'subtotal'  => $subtotal,
            ];
        }

        if (empty($items)) {
            return back()->with('error', 'Produk dalam keranjang tidak ditemukan!');
        }

        // Validasi form
        $request->validate([
            'nama'   => 'required',
            'phone'  => 'required',
            'alamat' => 'required',
        ]);

        // Simpan order ke DB (status pending)
        $order = Order::create([
            'name'    => $request->nama,
            'phone'   => $request->phone,
            'address' => $request->alamat,
            'items'   => $items,
            'total'   => $total,
            'status'  => 'pending',
        ]);

        // === Midtrans Snap ===
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $snapParams = [
    'transaction_details' => [
        // PASTIKAN order_id UNIK
        'order_id'     => 'ORDER-' . $order->id . '-' . time(),
        'gross_amount' => $total,
    ],
    'customer_details' => [
        'first_name' => $order->name,
        'phone'      => $order->phone,
        'address'    => $order->address,
    ],
    'item_details' => array_map(function($item) {
        return [
            'id'       => $item['menu_id'],
            'price'    => $item['price'],
            'quantity' => $item['qty'],
            'name'     => $item['menu_name'],
        ];
    }, $items),
    'enabled_payments' => ['gopay', 'shopeepay', 'qris', 'bank_transfer'],
];

        $snap = Snap::createTransaction($snapParams);
        $snapToken = $snap->token;

        session()->forget('cart');
        session()->forget('cart_count');

        return view('frontend.snap', [
            'snapToken' => $snapToken,
            'order_id'  => $order->id,
            'total'     => $total,
        ]);
    }
}
