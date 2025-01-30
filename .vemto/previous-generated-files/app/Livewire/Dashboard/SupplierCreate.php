<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Collection;
use App\Livewire\Dashboard\Suppliers\Forms\CreateForm;

class SupplierCreate extends Component
{
    use WithFileUploads;

    public CreateForm $form;

    public function mount()
    {
    }

    public function save()
    {
        $this->authorize('create', Supplier::class);

        $this->validate();

        $supplier = $this->form->save();

        return redirect()->route('dashboard.suppliers.edit', $supplier);
    }

    public function render()
    {
        return view('livewire.dashboard.suppliers.create', []);
    }
}
