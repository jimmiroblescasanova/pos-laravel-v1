<?php

namespace App\Http\Controllers\Reports;

use App\Exports\TicketSalesExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TicketSalesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('reports.ticket-sales.index');
    }

    public function download(Request $request)
    {
        return (new TicketSalesExport($request->toArray()))
            ->download('ventas_x_ticket-'.NOW()->format('Y-m-d').'.xlsx');
    }
}
