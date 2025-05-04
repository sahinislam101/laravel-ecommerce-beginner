<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FilerCategoryController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request,Category $category)
    {
        $categories = Category::all();
        $products = Product::where('category_id', $category->id)->get();
        return view('customer.dashboard',compact('categories','products'));

    }
}
