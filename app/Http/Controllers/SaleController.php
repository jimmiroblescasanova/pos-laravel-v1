<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class SaleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('sales.index');
    }

    public function show(Order $order)
    {
        return view('sales.show', [
            'order' => $order,
        ]);
    }

    public function print(Order $order)
    {
        $pdf = Pdf::loadView('pdf.ticket', [
            'order' => $order,
        ]);
        $pdf->setPaper('half-letter', 'portrait');
        
        return $pdf->stream();
    }
}
