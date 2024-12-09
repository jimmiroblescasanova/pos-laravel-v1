<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\View\View;
use Barryvdh\DomPDF\Facade\Pdf;

class SaleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(): View
    {
        return view('sales.index');
    }

    public function show(Order $order): View
    {
        return view('sales.show', [
            'order' => $order,
        ]);
    }

    public function cancel(Order $order)
    {
        $order->update([
            'canceled_at' => NOW(),
        ]);

        return back();
    }

    public function print(Order $order)
    {
        if (settings()->get('paper_size') == 'letter') {
            $pdf = Pdf::loadView('pdf.ticket', [
                'order' => $order,
            ]);

            $pdf->setPaper('letter', 'portrait');
        } else {
            $pdf = Pdf::loadView('pdf.ticket-small', [
                'order' => $order,
            ]);

            $pdf->setPaper(array(0, 0, 230, 912), 'portrait');
        }
        
        return $pdf->stream();
    }
}
