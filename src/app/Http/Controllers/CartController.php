<?php
namespace App\Http\Controllers;
use App\Models\Menu;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request) {
        $menu = Menu::findOrFail($request->menu_id);
        $cart = session()->get('cart', []);
        if (isset($cart[$menu->id])) {
            $cart[$menu->id]['qty']++;
        } else {
            $cart[$menu->id] = [
                "name" => $menu->name,
                "qty" => 1,
                "price" => $menu->price,
                "image" => $menu->image
            ];
        }
        session(['cart' => $cart]);
        session(['cart_count' => array_sum(array_column($cart, 'qty'))]);
        return redirect()->back()->with('success', 'Menu ditambahkan ke keranjang!');
    }

    public function index() {
        $cart = session('cart', []);
        return view('frontend.cart', compact('cart'));
    }

    public function update(Request $request) {
        $cart = session()->get('cart', []);
        $id = $request->menu_id;
        $action = $request->action;

        if(isset($cart[$id])) {
            if($action == 'increment') {
                $cart[$id]['qty'] += 1;
            } elseif($action == 'decrement' && $cart[$id]['qty'] > 1) {
                $cart[$id]['qty'] -= 1;
            }
            session(['cart' => $cart]);
            session(['cart_count' => array_sum(array_column($cart, 'qty'))]);
        }
        return redirect()->route('cart.index');
    }

    public function remove(Request $request) {
        $cart = session('cart', []);
        $id = $request->menu_id;
        unset($cart[$id]);
        session(['cart' => $cart]);
        session(['cart_count' => array_sum(array_column($cart, 'qty'))]);
        return redirect()->back();
    }
}
