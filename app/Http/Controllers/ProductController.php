<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;
use App\Exports\ProductsExport;
use App\Http\Requests\ProductDownloadRequest;
use App\Http\Requests\SaveProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Imports\ProductsImport;

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

        if($product->orderItems->count() >= 1)
        {
            notyf()
                ->ripple(true)
                ->duration(2000)
                ->addError('El producto tiene ventas.');

            return back();
        }

        $product->delete();
        notyf()
            ->ripple(true)
            ->duration(2000)
            ->addSuccess('Producto eliminado.');

        return redirect()->route('products.index');
    }

    public function download(ProductDownloadRequest $request)
    {
        return (new ProductsExport($request->status, $request->columns))
            ->download('productos.csv', Excel::CSV, ['Content-Type' => 'text/csv']);
    }

    public function import()
    {
        return view('products.import');
    }

    public function handleImport(Request $request)
    {
        $import = new ProductsImport();
        $import->import(request()->file('file'));
        
        if ($import->failures()->isNotEmpty()) {
            return back()->withFailures($import->failures());
        }

        notyf()
            ->ripple(true)
            ->duration(2000)
            ->addSuccess('Productos cargados con éxito.');

        return redirect()->route('products.index');
    }
}
