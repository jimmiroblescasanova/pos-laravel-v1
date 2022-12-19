<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    public function create()
    {
        $order = new Order();
        $orderOpen = Order::query()
            ->where([
                ['closed', 0],
                ['user_id', Auth::id(),]
            ])->latest()->first();

        if ($orderOpen == null) {
            $order = Order::create([
                'customer' => 'VENTA MOSTRADOR',
                'user_id' => Auth::id(),
            ]);
        } else {
            $order = $orderOpen;
        }

        return view('orders.pos', [
            'order' => $order,
        ]);
    }

    public function delete(Order $order)
    {
        try {
            DB::beginTransaction();
            // Eliminar los items del carrito
            $order->items()->delete();
            // Elliminar la orden
            $order->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            abort(403, $e->getMessage());
        }

        notyf()
            ->ripple(true)
            ->duration(2000)
            ->addSuccess('Orden cancelada');

        return redirect()->route('home');
    }

    public function printTicket(Order $order)
    {
        $pdf = Pdf::loadView('pdf.ticket', [
            'order' => $order,
        ]);
        $pdf->setPaper('half-letter', 'portrait');
        
        $content = $pdf->download()->getOriginalContent();
        $filePath = 'tickets/'.$order->id.'.pdf';

        Storage::put('public/'.$filePath, $content) ;

        return view('orders.print', compact('filePath'));
    }
}
