<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $historySales = Order::query()
            ->select(DB::raw("SUM(total/100) sales"), DB::raw("MONTH(updated_at) month"))
            ->whereYear('updated_at', date('Y'))
            ->onlyClosed()
            ->groupBy('month')
            ->get()
            ->pluck('sales', 'month');

        $chartLabels = $historySales->keys();
        $chartData = $historySales->values();

        $top10products = Product::query()
            ->where('active', true)
            ->orderBy('total_sales', 'desc')
            ->limit(5)
            ->get();

        return view('home', [
            'chartLabels' => $chartLabels,
            'chartData' => $chartData,
            'top10products' => $top10products,
        ]);
    }
}
