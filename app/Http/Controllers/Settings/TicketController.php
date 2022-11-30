<?php

namespace App\Http\Controllers\Settings;

use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use App\Models\BusinessSettings;

class TicketController extends Controller
{
    public function printTicket(Order $order)
    {
        $pdf = Pdf::loadView('tickets.ticket', [
            'order' => $order,
            'business' => BusinessSettings::findOrFail(1),
        ]);
        $pdf->setPaper('half-letter', 'portrait');
        return $pdf->stream();
    }
}
