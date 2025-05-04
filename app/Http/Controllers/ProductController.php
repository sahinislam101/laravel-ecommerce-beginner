<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Str;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        $products = Product::latest()->get();
        return view('vendor.product.index',compact('categories','products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('vendor.product.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $product = new Product;
        $product->user_id =Auth::id();
        // add image
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'),$imageName);

        // add all product item
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->category_id = $request->category_id;
        $product->image = $imageName;

        $product->save();

        return redirect()->route('products.index')
        ->with('success','Product Created Successfully');


    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {

        $categories = Category::all();
        return view('vendor.product.edit',compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->user_id = Auth::id();

    // যদি নতুন ছবি আসে, তাহলে আপডেট করবো
    if ($request->hasFile('image')) {
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);
        $product->image = $imageName;
    }

    // অন্যান্য ডেটা আপডেট
    $product->name = $request->name;
    $product->description = $request->description;
    $product->price = $request->price;
    $product->stock = $request->stock;
    $product->category_id = $request->category_id;

    $product->save();

    return redirect()->route('products.index')->with('success','Product Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->deleteOrFail();

        return redirect()->route('products.index')
        ->with('success','Product Deleted Successfully');
    }
}
