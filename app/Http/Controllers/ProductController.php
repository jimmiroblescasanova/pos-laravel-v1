<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;
use App\Http\Requests\SaveProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    public function __construct(){
        return $this->middleware('auth');
    }

    public function index(): View
    {
        return view('products.index');
    }

    public function create(): View
    {
        $product = new Product();
        return view('products.create', compact('product'));
    }

    public function store(SaveProductRequest $request)
    {
        $product = Product::create($request->validated());

        if ($request->has('image')) {
            $product->addMediaFromRequest('image')->toMediaCollection('product');
        }

        return redirect()->route('products.index');
    }

    public function edit(Product $product): View
    {
        return view('products.edit', compact('product'));
    }

    public function update(Product $product, UpdateProductRequest $request)
    {
        $product->update($request->validated());

        if ($request->has('image')) {
            $product->addMediaFromRequest('image')->toMediaCollection('product');
        }

        return redirect()->route('products.index');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index');
    }
}
