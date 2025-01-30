<?php

namespace App\Livewire\Dashboard\Orders\Forms;

use Livewire\Form;
use App\Models\Order;
use Livewire\Attributes\Rule;

class CreateDetailForm extends Form
{
    public $supplier_id = null;

    #[Rule('required')]
    public $warehouse_id = '';

    #[Rule('required|string')]
    public $name = '';

    #[Rule('required|string')]
    public $status = '';

    public function save()
    {
        $this->validate();

        $order = Order::create($this->except([]));

        $this->reset();

        return $order;
    }
}
