<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;

class DailySalesController extends Controller
{
    public function __invoke()
    {
        return view('reports.daily-sales.index');
    }
}
