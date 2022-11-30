<?php

namespace App\Http\Livewire\Settings;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\BusinessSettings;

class Business extends Component
{
    use WithFileUploads;

    public $company;
    public $name;
    public $address;
    public $admin_email;
    public $logo;

    protected $rules = [
        'name' => 'required|min:6',
        'address' => 'nullable|min:6',
        'admin_email' => 'nullable|email',
        'logo' => ['nullable', 'image', 'size:100']
    ];

    public function mount()
    {
        $this->company = BusinessSettings::find(1);
        $this->name = $this->company->name;
        $this->address = $this->company->address;
        $this->admin_email = $this->company->admin_email;
    }

    public function updated($name)
    {
        $this->validateOnly($name);
    }

    public function save()
    {
        $validatedData = $this->validate();

        $this->company->update($validatedData);

        if ($this->logo != null) {
            $logo = $this->logo->store('images', 'public');
            $this->company->update([
                'logo' => $logo,
            ]);
        }

        notyf()
            ->ripple(true)
            ->duration(1500)
            ->addSuccess('Información actualizada');
    }

    public function render()
    {
        return view('livewire.settings.business');
    }
}
