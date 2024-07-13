<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function productList()
    {
        $products = Product::select('products.*', 'categories.name as category_name')
            ->leftJoin('categories', 'products.category_id', 'categories.category_id')
            ->orderby('product_id', 'asc')
            ->paginate(4);
        return view('admin.products.list', compact('products'));
    }

    public function createProductPage(Request $request)
    {
        $categories = Category::select('category_id', 'name')->get();
        return view('admin.products.create', compact('categories'));
    }

    public function createProduct(Request $request)
    {
        $validator = $this->productValidator($request);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('productPhoto')) {
            $productPhotoPath = Storage::disk('public')->put('/product-photos', $request->file('productPhoto'));
        }
        Product::create([
            'name' => $request->productName,
            'category_id' => $request->categoryId,
            'description' => $request->productDescription,
            'product_photo_path' => $productPhotoPath ??= null,
            'price' => $request->productPrice,
            'waiting_times' => intval($request->waitingTimes),
        ]);

        return redirect()->route('admin#products#list')->with('msg', 'product created successfully!');
    }

    public function updateProductPage($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::select('category_id', 'name')->get();

        return view('admin.products.update', compact('product', 'categories'));
    }

    public function updateProduct(Request $request, $id)
    {
        $validator = $this->productValidator($request, $id);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $product = Product::findOrFail($id);

        if ($request->hasFile('productPhoto')) {
            if ($product->product_photo_path) {
                Storage::disk('public')->delete($product->product_photo_path);
            }
            $productPhotoPath = Storage::disk('public')->put('/product-photos', $request->file('productPhoto'));
            $product->product_photo_path = $productPhotoPath;
        }

        $product->name = $request->productName;
        $product->category_id = $request->categoryId;
        $product->description = $request->productDescription;
        $product->price = $request->productPrice;
        $product->waiting_times = intval($request->waitingTimes);
        $product->save();
        return redirect()->route('admin#products#list')->with('msg', 'product updated successfully!');
    }

    public function deleteProduct($id)
    {
        Product::where('product_id', $id)->delete();
        return back()->with('msg', 'product deleted successfully!');
    }

    public function searchProduct(Request $request)
    {
        $searchKey = $request->has('searchKey') ? $request->searchKey : '';

        $products = Product::select('products.*', 'categories.name as category_name')
            ->leftJoin('categories', 'products.category_id', 'categories.category_id')->where('products.name', 'like', '%' . $searchKey . '%')
            ->orderBy('products.product_id', 'asc')
            ->paginate(5);
        $products->appends($request->all());
        return view('admin.products.list', compact('products', 'searchKey'));
    }

    private function productValidator(Request $request, $id = null)
    {
        if ($id !== null) {
            return Validator::make(
                $request->all(),
                [
                    'productName' => 'required|unique:products,name,' . $id . ',product_id',
                    'productDescription' => 'required',
                    'categoryId' => 'required',
                    'productPhoto' => 'mimes:jpg,jpeg,png|max:1024',
                    'waitingTimes' => 'required',
                    'productPrice' => 'required',
                ],
                [
                    'productPhoto' => 'file must be jpg, jpeg, png'
                ]
            );
        }
        return Validator::make(
            $request->all(),
            [
                'productName' => 'required|unique:categories,name',
                'productDescription' => 'required',
                'categoryId' => 'required',
                'productPhoto' => 'required|mimes:jpg,jpeg,png|max:1024',
                'waitingTimes' => 'required',
                'productPrice' => 'required',
            ]
        );
    }
}
