<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    public function productFilter(Request $request)
    {
        logger($request->all());
        if ($request->status == 'pLow') {
            return Product::select('products.*', 'categories.name as category_name')
                ->leftJoin('categories', 'products.category_id', 'categories.category_id')
                ->orderBy('price', 'asc')->get();
        } elseif ($request->status == 'phigh') {
            return Product::select('products.*', 'categories.name as category_name')
                ->leftJoin('categories', 'products.category_id', 'categories.category_id')
                ->orderBy('price', 'desc')->get();
        } elseif ($request->status == 'vLow') {
            return Product::select('products.*', 'categories.name as category_name')
                ->leftJoin('categories', 'products.category_id', 'categories.category_id')
                ->orderBy('view_count', 'asc')->get();
        } elseif ($request->status == 'vhigh') {
            return Product::select('products.*', 'categories.name as category_name')
                ->leftJoin('categories', 'products.category_id', 'categories.category_id')
                ->orderBy('view_count', 'desc')->get();
        }
    }

    public function addToCart(Request $request)
    {
        logger($request->all());
        $cart_data = Cart::select('carts.*', 'products.name as pizza_name', 'products.price')
            ->leftJoin('products', 'carts.product_id', 'products.product_id')
            ->where('user_id', Auth::user()->id)
            ->get();

        foreach ($cart_data as $cart) {
            if ($cart->user_id == $request->userId && $cart->product_id == $request->pizzaId) {
                Cart::where('user_id', '=', $request->userId)
                    ->where('product_id', '=', $request->pizzaId)->update([
                        'qty' => $request->quantity + $cart->qty
                    ]);
                return response()->json([
                    'message' => 'Cart updated with increased quantity',
                    'status' => 'success'
                ]);
            } else {
            }
        }

        // If the product is not already in the cart, add it.
        Cart::create([
            'user_id' => $request->userId,
            'product_id' => $request->pizzaId,
            'qty' => $request->quantity
        ]);

        return response()->json([
            'message' => 'Pizza added to cart',
            'status' => 'success'
        ]);
    }

    public function editCart(Request $request)
    {
        logger($request->all());
        $cart = Cart::findOrFail($request->cartId);
        $cart->qty = $request->quantity;
        $cart->save();

        $cart = Cart::select('carts.*', 'products.name as pizza_name', 'products.price')
            ->leftJoin('products', 'carts.product_id', 'products.product_id')
            ->where('user_id', Auth::user()->id)
            ->where('carts.cart_id', $request->cartId)
            ->get()->toArray();

        $carts = Cart::select('carts.*', 'products.name as pizza_name', 'products.price')
            ->leftJoin('products', 'carts.product_id', 'products.product_id')
            ->where('user_id', Auth::user()->id)
            ->get();
        $subTotal = 0;

        foreach ($carts as $item) {
            $subTotal += $item->price * $item->qty; // Assuming 'price' is the property representing the item's price
        }
        $totalPrice = $subTotal + 3000;


        return response()->json([
            'data' => $cart,
            'subtotal' => $subTotal,
            'totalprice' => $totalPrice
        ]);
    }

    public function deleteCart(Request $request)
    {
        logger($request->all());
        Cart::findOrFail($request->cartId)->delete();

        $carts = Cart::select('carts.*', 'products.name as pizza_name', 'products.price')
            ->leftJoin('products', 'carts.product_id', 'products.product_id')
            ->where('user_id', Auth::user()->id)
            ->get();
        $subTotal = 0;

        foreach ($carts as $item) {
            $subTotal += $item->price * $item->qty; // Assuming 'price' is the property representing the item's price
        }
        $totalPrice = $subTotal + 3000;


        return response()->json([
            'msg' => 'delete',
            'subtotal' => $subTotal,
            'totalprice' => $totalPrice
        ]);
    }
    public function clearCart()
    {
        Cart::where('user_id', Auth::user()->id)->delete();
        return response()->json([
            'msg' => 'clear'
        ]);
    }

    public function orderStatus(Request $request)
    {
        logger($request->all());
        $order = Order::findOrFail($request->orderid);
        $order->status = $request->status;
        $order->save();

        if ($order->status == 'pending') {
            return response()->json([
                'msg' => 'Order Pending Success!'
            ]);
        } elseif ($order->status == 'processing') {
            return response()->json([
                'msg' => 'Order Processing Success!'
            ]);
        } elseif ($order->status == 'delivered') {
            return response()->json([
                'msg' => 'Order Delivering Success!'
            ]);
        } elseif ($order->status == 'rejected') {
            return response()->json([
                'msg' => 'Order Rejecting Success!'
            ]);
        }
    }

    public function orderFilter(Request $request)
    {
        logger($request->all());

        if ($request->filter == 'filter') {
            return Order::select('orders.*', 'users.id', 'users.name', 'users.email', 'users.phone', 'users.address')
                ->leftJoin('users', 'orders.user_id', 'users.id')
                ->get();
        } elseif ($request->filter == 'pending') {
            return Order::select('orders.*', 'users.id', 'users.name', 'users.email', 'users.phone', 'users.address')
                ->leftJoin('users', 'orders.user_id', 'users.id')
                ->where('orders.status', 'pending')
                ->get();
        } elseif ($request->filter == 'processing') {
            return Order::select('orders.*', 'users.id', 'users.name', 'users.email', 'users.phone', 'users.address')
                ->leftJoin('users', 'orders.user_id', 'users.id')
                ->where('orders.status', 'processing')
                ->get();
        } elseif ($request->filter == 'delivered') {
            return Order::select('orders.*', 'users.id', 'users.name', 'users.email', 'users.phone', 'users.address')
                ->leftJoin('users', 'orders.user_id', 'users.id')
                ->where('orders.status', 'delivered')
                ->get();
        } elseif ($request->filter == 'rejected') {
            return Order::select('orders.*', 'users.id', 'users.name', 'users.email', 'users.phone', 'users.address')
                ->leftJoin('users', 'orders.user_id', 'users.id')
                ->where('orders.status', 'rejected')
                ->get();
        }
    }

    public function viewCount(Request $request)
    {
        logger(
            $request->all()
        );

        $product = Product::findOrFail($request->productId);
        $product->view_count += 1;
        $product->save();
    }
}
