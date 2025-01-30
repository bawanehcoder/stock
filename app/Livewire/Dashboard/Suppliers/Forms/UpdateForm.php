<?php

namespace App\Livewire\Dashboard\Suppliers\Forms;

use Livewire\Form;
use App\Models\Supplier;
use Illuminate\Validation\Rule;

class UpdateForm extends Form
{
    public ?Supplier $supplier;

    public $name = '';

    public $phone = '';

    public $location = '';

    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'location' => ['required', 'string'],
        ];
    }

    public function setSupplier(Supplier $supplier)
    {
        $this->supplier = $supplier;

        $this->name = $supplier->name;
        $this->phone = $supplier->phone;
        $this->location = $supplier->location;
    }

    public function save()
    {
        $this->validate();

        $this->supplier->update($this->except(['supplier']));
    }
}
