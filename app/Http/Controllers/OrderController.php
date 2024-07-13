<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Orderlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function list(Request $request)
    {
        if (Auth::user()->role == 'admin') {
            $orders = Order::select('orders.*', 'users.id', 'users.name', 'users.email', 'users.phone', 'users.address')
                ->when($request->filterStatus, function ($query, $filterStatus) {
                    return $query->where('orders.status', $filterStatus);
                })
                ->leftJoin('users', 'orders.user_id', 'users.id')
                ->paginate(5);

            return view('admin.orders.list', compact('orders'));
        } elseif (Auth::user()->role == 'user') {
            $order = Order::where('user_id', Auth::user()->id)->paginate(8);
            return view('user.order.list', compact('order'));
        } else {
            return 'Who the hell are you!🤨';
        }
    }

    public function orderProceed()
    {
        $cart = Cart::select('carts.*', 'products.name as pizza_name', 'products.price')
            ->leftJoin('products', 'carts.product_id', 'products.product_id')
            ->where('user_id', Auth::user()->id)
            ->get();

        if ($cart->count() > 0) {
            $subTotal = 0;
            foreach ($cart as $item) {
                $subTotal += $item->price * $item->qty; // Assuming 'price' is the property representing the item's price
            }
            $totalPrice = $subTotal + 3000;
            $order = Order::create([
                'user_id' => Auth::user()->id,
                'total_price' => $totalPrice,
                'order_code' => 'POS' . date('YmdHis')
            ]);

            foreach ($cart as $item) {
                Orderlist::create([
                    'order_code' => $order->order_code,
                    'product_id' => $item->product_id,
                    'quantity' => $item->qty,
                    'price_per_unit' => $item->price,
                    'total_price' => $item->price * $item->qty
                ]);
            }
            Cart::where('user_id', '=', Auth::user()->id)->delete();
            return redirect()->route('user#shop');
        } else {
            return redirect()->route('user#shop');
        }

    }

    public function searchPage(Request $request)
    {
        $searchKey = $request->has('searchKey') ? $request->searchKey : '';

        $orders = Order::select('orders.*', 'users.id', 'users.name', 'users.email', 'users.phone', 'users.address')
            ->leftJoin('users', 'orders.user_id', 'users.id')
            ->where('users.name', 'like', '%' . $searchKey . '%')
            ->orderBy('orders.order_id', 'asc')
            ->paginate(5);
        $orders->appends($request->all());
        return view('admin.orders.list', compact('orders', 'searchKey'));
    }

    public function productList($ordercode)
    {
        $product = Order::select('orderlists.*', 'orders.total_price as final_price', 'orders.order_date', 'users.name', 'users.email', 'users.phone', 'users.address', 'products.name as product_name', 'products.price as product_price', 'products.product_photo_path', 'products.view_count')
            ->join('orderlists', 'orderlists.order_code', 'orders.order_code')
            ->join('products', 'orderlists.product_id', 'products.product_id')
            ->leftJoin('users', 'orders.user_id', 'users.id')
            ->where('orderlists.order_code', $ordercode)
            ->paginate(5);

        // dd($product->toArray());

        return view('admin.orders.products.list', compact('product'));
    }
}
