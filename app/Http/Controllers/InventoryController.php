<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('inventory.index');
    }

    public function update(Request $request)
    {
        $product = Product::findOrFail($request->product);

        $product->update([
            'minimum'   => $request->minimum,
            'inventory' => $request->inventory,
        ]);

        notyf()
            ->ripple(true)
            ->duration(2000)
            ->addSuccess('Inventario actualizado con éxito.');

        return back();
    }
}
