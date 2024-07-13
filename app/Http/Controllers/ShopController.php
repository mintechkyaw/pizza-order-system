<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class ShopController extends Controller
{
    public function index(Request $request)
    {
        $datas = Product::select('products.*', 'categories.name as category_name')
            ->leftJoin('categories', 'products.category_id', 'categories.category_id')
            ->when($request->categoryId, function ($query, $categoryId) {
                return $query->where('products.category_id', $categoryId);
            })
            ->get();

        $categories = Category::orderby('category_id', 'asc')->paginate(5);

        return view('user.shop.shop', compact('datas', 'categories'))->with('msg', $request->categoryId);
    }

    public function pizzaDetails($id)
    {
        $product = Product::select('products.*', 'categories.name as category_name')
            ->leftJoin('categories', 'products.category_id', 'categories.category_id')
            ->where('products.product_id', $id)->first();
        $rating = Rating::where('user_id', Auth::user()->id)->where('product_id',$id)->first();
       
        return view('user.main.details', compact('product','rating'));
    }
};
