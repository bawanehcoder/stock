<?php

namespace App\Livewire\Dashboard;

use Livewire\Form;
use App\Models\Order;
use Livewire\Component;
use App\Models\Supplier;
use App\Models\Warehouse;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use App\Livewire\Dashboard\Orders\Forms\CreateDetailForm;
use App\Livewire\Dashboard\Orders\Forms\UpdateDetailForm;

class SupplierOrdersDetail extends Component
{
    use WithFileUploads, WithPagination;

    public CreateDetailForm|UpdateDetailForm $form;

    public ?Order $order;
    public Supplier $supplier;

    public Collection $warehouses;

    public $showingModal = false;

    public $detailOrdersSearch = '';
    public $detailOrdersSortField = 'updated_at';
    public $detailOrdersSortDirection = 'desc';

    public $queryString = [
        'detailOrdersSearch',
        'detailOrdersSortField',
        'detailOrdersSortDirection',
    ];

    public $confirmingOrderDeletion = false;
    public string $deletingOrder;

    public function mount()
    {
        $this->form = new CreateDetailForm($this, 'form');

        $this->warehouses = Warehouse::pluck('name', 'id');
    }

    public function newOrder()
    {
        $this->form = new CreateDetailForm($this, 'form');
        $this->order = null;

        $this->showModal();
    }

    public function editOrder(Order $order)
    {
        $this->form = new UpdateDetailForm($this, 'form');
        $this->form->setOrder($order);
        $this->order = $order;

        $this->showModal();
    }

    public function showModal()
    {
        $this->showingModal = true;
    }

    public function closeModal()
    {
        $this->showingModal = false;
    }

    public function confirmOrderDeletion(string $id)
    {
        $this->deletingOrder = $id;

        $this->confirmingOrderDeletion = true;
    }

    public function deleteOrder(Order $order)
    {
        $this->authorize('delete', $order);

        $order->delete();

        $this->confirmingOrderDeletion = false;
    }

    public function save()
    {
        if (empty($this->order)) {
            $this->authorize('create', Order::class);
        } else {
            $this->authorize('update', $this->order);
        }

        $this->form->supplier_id = $this->supplier->id;
        $this->form->save();

        $this->closeModal();
    }

    public function sortBy($field)
    {
        if ($this->detailOrdersSortField === $field) {
            $this->detailOrdersSortDirection =
                $this->detailOrdersSortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->detailOrdersSortDirection = 'asc';
        }

        $this->detailOrdersSortField = $field;
    }

    public function getRowsProperty()
    {
        return $this->rowsQuery->paginate(5);
    }

    public function getRowsQueryProperty()
    {
        return $this->supplier
            ->orders()
            ->orderBy(
                $this->detailOrdersSortField,
                $this->detailOrdersSortDirection
            )
            ->where('name', 'like', "%{$this->detailOrdersSearch}%");
    }

    public function render()
    {
        return view('livewire.dashboard.suppliers.orders-detail', [
            'detailOrders' => $this->rows,
        ]);
    }
}
