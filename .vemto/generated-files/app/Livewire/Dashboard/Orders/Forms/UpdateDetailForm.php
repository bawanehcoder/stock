<?php

namespace App\Livewire\Dashboard\Orders\Forms;

use Livewire\Form;
use App\Models\Order;
use Livewire\Attributes\Rule;

class UpdateDetailForm extends Form
{
    public ?Order $order;

    public $warehouse_id = '';

    public $name = '';

    public $status = '';

    public function rules(): array
    {
        return [
            'warehouse_id' => ['required'],
            'name' => ['required', 'string'],
            'status' => ['required', 'string'],
        ];
    }

    public function setOrder(Order $order)
    {
        $this->order = $order;

        $this->warehouse_id = $order->warehouse_id;
        $this->name = $order->name;
        $this->status = $order->status;
    }

    public function save()
    {
        $this->validate();

        $this->order->update($this->except(['order', 'warehouse_id']));
    }
}
