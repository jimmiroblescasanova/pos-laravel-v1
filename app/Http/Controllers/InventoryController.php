<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Exports\InventoryExport;
use App\Imports\InventoryImport;
use App\Http\Requests\UpdateInventoryRequest;

class InventoryController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('inventory.index');
    }

    public function update(UpdateInventoryRequest $request)
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

    public function export(Request $request)
    {
        return (new InventoryExport($request->type))->download('inventario_'.NOW()->format('dmY').'.xlsx');
    }

    public function import()
    {
        return view('inventory.import');
    }

    public function handleImport()
    {

        $import = new InventoryImport();
        $import->import(request()->file('file'));
        
        if ($import->failures()->isNotEmpty()) {
            return back()->withFailures($import->failures());
        }

        notyf()
            ->ripple(true)
            ->duration(2000)
            ->addSuccess('Inventario cargado con éxito.');

        return redirect()->route('inventory.index');
    }
}
