<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Supplier;
use Illuminate\Support\Collection;
use App\Livewire\Dashboard\Suppliers\Forms\UpdateForm;

class SupplierEdit extends Component
{
    public ?Supplier $supplier = null;

    public UpdateForm $form;

    public function mount(Supplier $supplier)
    {
        $this->authorize('view-any', Supplier::class);

        $this->supplier = $supplier;

        $this->form->setSupplier($supplier);
    }

    public function save()
    {
        $this->authorize('update', $this->supplier);

        $this->validate();

        $this->form->save();

        $this->dispatch('saved');
    }

    public function render()
    {
        return view('livewire.dashboard.suppliers.edit', []);
    }
}
