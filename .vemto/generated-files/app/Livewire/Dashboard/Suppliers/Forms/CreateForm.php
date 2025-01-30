<?php

namespace App\Livewire\Dashboard\Suppliers\Forms;

use Livewire\Form;
use App\Models\Supplier;
use Livewire\Attributes\Rule;

class CreateForm extends Form
{
    #[Rule('required|string')]
    public $name = '';

    #[Rule('required|string')]
    public $phone = '';

    #[Rule('required|string')]
    public $location = '';

    public function save()
    {
        $this->validate();

        $supplier = Supplier::create($this->except([]));

        $this->reset();

        return $supplier;
    }
}
