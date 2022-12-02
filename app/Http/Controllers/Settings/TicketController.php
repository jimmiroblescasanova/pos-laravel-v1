<?php

namespace App\Http\Controllers\Settings;

use App\Models\Order;
use App\Models\TicketSettings;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\BusinessSettings;
use App\Http\Controllers\Controller;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('settings.ticket');
    }

    public function printTicket(Order $order)
    {
        $pdf = Pdf::loadView('tickets.ticket', [
            'order' => $order,
            'business' => BusinessSettings::findOrFail(1),
            'ticket' => TicketSettings::findOrFail(1),
        ]);
        $pdf->setPaper('half-letter', 'portrait');
        return $pdf->stream();
    }
}
