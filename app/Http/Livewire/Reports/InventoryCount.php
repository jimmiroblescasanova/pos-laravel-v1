<?php

namespace App\Http\Livewire\Reports;

use Livewire\Component;

class InventoryCount extends Component
{
    public $pdfUrl = null;
    
    public function render()
    {
        return view('livewire.reports.inventory-count', [
            'pdf' => $this->pdfUrl,
        ]);
    }
}
