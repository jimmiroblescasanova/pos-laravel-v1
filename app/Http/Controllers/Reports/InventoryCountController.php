<?php

namespace App\Http\Controllers\Reports;

use Illuminate\View\View;
use App\Http\Controllers\Controller;

class InventoryCountController extends Controller
{
    public function __invoke(): View
    {
        return view('reports.inventory-count.index');
    }
}
