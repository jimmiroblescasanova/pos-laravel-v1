<?php

namespace App\Http\Livewire\Reports;

use App\Models\Product;
use Livewire\Component;
use App\Models\OrderItem;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class ProductSales extends Component
{
    public $products;
    public $pdfUrl = null;
    public $form;

    protected $rules = [
        'form.startDate'    => 'required|date',
        'form.endDate'      => 'required|date|after_or_equal:form.startDate',
    ];

    public function mount()
    {
        $this->products = Product::pluck('name', 'id');
        $this->form['product'] = 'all';
    }

    public function pdf()
    {
        $this->validate();

        $result = OrderItem::query()
        ->whereBetween('updated_at', [$this->form['startDate'], $this->form['endDate']." 23:59:59"])
        ->when($this->form['product'] != 'all', function($q) {
            $q->where('product_id', $this->form['product']);
        })
        ->get()
        ->groupBy('product.name');

        $pdf = Pdf::loadView('reports.product-sales.pdf', [
            'orderItems' => $result,
            'startDate' => Carbon::parse($this->form['startDate'])->format('d/m/Y'),
            'endDate' => Carbon::parse($this->form['endDate'])->format('d/m/Y'),
        ]);
        $content = $pdf->download()->getOriginalContent();
        $this->pdfUrl = 'reports/product-sales-'.date('his').'.pdf';

        Storage::put('public/'.$this->pdfUrl, $content);
    }

    public function render()
    {
        return view('livewire.reports.product-sales', [
            'pdf' => $this->pdfUrl,
        ]);
    }
}
