<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function list()
    {
        $cart = Cart::select('carts.*', 'products.name as pizza_name', 'products.price')
            ->leftJoin('products', 'carts.product_id', 'products.product_id')
            ->where('user_id', Auth::user()->id)
            ->paginate(8);
        $subTotal = 0;

        foreach ($cart as $item) {
            $subTotal += $item->price * $item->qty; // Assuming 'price' is the property representing the item's price
        }
        $totalPrice = $subTotal+3000;
        // dd($cart->toArray());
        return view('user.cart.list', compact('cart','subTotal','totalPrice'));
    }


}
