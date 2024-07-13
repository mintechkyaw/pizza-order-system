<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function categoryList()
    {
        $categories = Category::orderby('category_id', 'asc')->paginate(5);
        return view('admin.categories.list', compact('categories'));
    }

    public function createCategoryPage()
    {
        return view('admin.categories.create');
    }

    public function createCategory(Request $request)
    {
        $validator = $this->categoryValidator($request);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // If validation passes, proceed with category creation
        Category::create([
            'name' => $request->categoryName
        ]);
        return redirect()->route('admin#categories#list')->with('msg', 'category created successfully!');
    }

    public function updateCategoryPage($id)
    {
        $category = Category::findOrFail($id);

        return view('admin.categories.update', compact('category'));
    }

    public function updateCategory(Request $request, $id)
    {
        $validator = $this->categoryValidator($request, $id);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $category = Category::findOrFail($id);
        $category->name = $request->categoryName;
        $category->save();

        return redirect()->route('admin#categories#list')->with('msg', 'category updated successfully!');
    }

    public function deleteCategory($id)
    {
        Category::where('category_id', $id)->delete();
        return back()->with('msg', 'category deleted successfully!');
    }

    public function searchCategory(Request $request)
    {
        $searchKey = $request->has('searchKey') ? $request->searchKey : '';
        $categories = Category::where('name', 'like', '%' . $searchKey . '%')
            ->orderBy('category_id', 'asc')
            ->paginate(5);
        $categories->appends($request->all());
        return view('admin.categories.list', compact('categories', 'searchKey'));
    }

    private function categoryValidator(Request $request, $id = null)
    {
        if ($id !== null) {
            return Validator::make(
                $request->all(),
                [
                    'categoryName' => 'required|unique:categories,name,' . $id . ',category_id',
                ]
            );
        }
        return Validator::make(
            $request->all(),
            [
                'categoryName' => 'required|unique:categories,name',
            ]
        );
    }
}
