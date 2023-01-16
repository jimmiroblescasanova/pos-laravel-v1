<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;

class ProductSalesController extends Controller
{
    public function __invoke()
    {
        return view('reports.product-sales.index');
    }
}
