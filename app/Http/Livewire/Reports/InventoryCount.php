<?php

namespace App\Http\Livewire\Reports;

use App\Models\Group;
use App\Models\Product;
use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class InventoryCount extends Component
{
    public $pdfUrl = null;
    public $categories;
    public $form;

    public function mount() {
        $this->form['group'] = 'all';
        $this->categories = Group::pluck('name', 'id');
    }

    public function pdf() {
        $products = Product::query()
            ->when($this->form['group'] != 'all', function($q) {
                $q->where('group_id', $this->form['group']);
            })->when($this->form['withInventory'] == true, function($q){
                $q->where('inventory', '>=', 1);
            })->when($this->form['active'] == true, function($q){
                $q->where('active', true);
            })->get()->groupBy('group.name');

        $pdf = Pdf::loadView('reports.inventory-count.pdf', [
            'products' => $products,
        ]);
        $content = $pdf->download()->getOriginalContent();
        $this->pdfUrl = 'reports/inventory-count-'.date('his').'.pdf';

        Storage::put('public/'.$this->pdfUrl, $content);
    }
    
    public function render()
    {
        return view('livewire.reports.inventory-count', [
            'pdf' => $this->pdfUrl,
        ]);
    }
}
