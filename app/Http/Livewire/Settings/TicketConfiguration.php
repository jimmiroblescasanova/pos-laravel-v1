<?php

namespace App\Http\Livewire\Settings;

use Livewire\Component;
use App\Models\TicketSettings;
use App\Models\BusinessSettings;

class TicketConfiguration extends Component
{
    public $business;
    public $ticket;
    public $greeting_1, $greeting_2, $greeting_3;
    public $signature_line;

    protected $rules = [
        'greeting_1' => 'nullable|string|min:10',
        'greeting_2' => 'nullable|string|min:10',
        'greeting_3' => 'nullable|string|min:10',
        'signature_line' => 'boolean',
    ];

    public function mount()
    {
        $this->business = BusinessSettings::find(1);
        $this->ticket = TicketSettings::find(1);
        $this->greeting_1 = $this->ticket->greeting_1;
        $this->greeting_2 = $this->ticket->greeting_2;
        $this->greeting_3 = $this->ticket->greeting_3;
        $this->signature_line = $this->ticket->signature_line;
    }

    public function updated($field, $value)
    {
        $this->validateOnly($field);
        $this->ticket->update([
            $field => $value,
        ]);

        notyf()
            ->ripple(true)
            ->duration(1500)
            ->addInfo('Campo actualizado');
    }

    public function render()
    {
        return view('livewire.settings.ticket-configuration');
    }
}
