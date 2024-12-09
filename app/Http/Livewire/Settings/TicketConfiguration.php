<?php

namespace App\Http\Livewire\Settings;

use Livewire\Component;

class TicketConfiguration extends Component
{
    public $greeting_1, $greeting_2, $greeting_3;
    public $signature_line;
    public $paper_size;

    protected $rules = [
        'greeting_1' => 'nullable|string|min:10',
        'greeting_2' => 'nullable|string|min:10',
        'greeting_3' => 'nullable|string|min:10',
        'signature_line' => 'boolean',
    ];

    public function mount()
    {
        $this->greeting_1 = settings()->get('greeting_1');
        $this->greeting_2 = settings()->get('greeting_2');
        $this->greeting_3 = settings()->get('greeting_3');
        $this->signature_line = settings()->get('signature_line');
        $this->paper_size = settings()->get('paper_size');
    }

    public function updated($field, $value)
    {
        $this->validateOnly($field);
        settings()->set($field, $value);

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
