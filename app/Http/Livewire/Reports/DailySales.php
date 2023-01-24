<?php

namespace App\Http\Livewire\Reports;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class DailySales extends Component
{
    public $users;
    public $pdfUrl = null;
    public $form;

    protected $rules = [
        'form.date' => ['required', 'date', 'before_or_equal:today'],
    ];

    public function mount()
    {
        $this->users = User::query()
            ->hideAdmin()
            ->pluck('name', 'id');
        $this->form['user'] = 'all';
    }

    public function pdf()
    {
        $this->validate();

        $result = Order::query()
        ->where('closed', true)
        ->whereDate('updated_at', $this->form['date'])
        ->when($this->form['user'] != 'all', function($q) {
            $q->where('user_id', $this->form['user']);
        })
        ->get();

        $pdf = Pdf::loadView('reports.daily-sales.pdf', [
            'documents' => $result,
            'date' => Carbon::parse($this->form['date']),
        ]);
        $content = $pdf->download()->getOriginalContent();
        $this->pdfUrl = 'reports/daily-sales-'.date('his').'.pdf';

        Storage::put('public/'.$this->pdfUrl, $content);
    }

    public function render()
    {
        return view('livewire.reports.daily-sales', [
            'pdf' => $this->pdfUrl,
        ]);
    }
}
