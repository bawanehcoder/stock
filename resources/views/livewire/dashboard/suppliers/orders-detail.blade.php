<div>
    <div class="flex justify-between align-top py-4">
        <x-ui.input
            wire:model.live="detailOrdersSearch"
            type="text"
            placeholder="Search {{ __('crud.orders.collectionTitle') }}..."
        />

        @can('create', App\Models\Order::class)
        <a wire:click="newOrder()">
            <x-ui.button>New</x-ui.button>
        </a>
        @endcan
    </div>

    {{-- Modal --}}
    <x-ui.modal wire:model="showingModal">
        <div class="overflow-hidden border rounded-lg bg-white">
            <form class="w-full mb-0" wire:submit.prevent="save">
                <div class="p-6 space-y-3">
                    <div class="w-full">
                        <x-ui.label for="warehouse_id"
                            >{{ __('crud.orders.inputs.warehouse_id.label')
                            }}</x-ui.label
                        >
                        <x-ui.input.select
                            wire:model="form.warehouse_id"
                            name="warehouse_id"
                            id="warehouse_id"
                            class="w-full"
                        >
                            <option value="">Select data</option>
                            @foreach ($warehouses as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </x-ui.input.select>
                        <x-ui.input.error for="form.warehouse_id" />
                    </div>

                    <div class="w-full">
                        <x-ui.label for="name"
                            >{{ __('crud.orders.inputs.name.label')
                            }}</x-ui.label
                        >
                        <x-ui.input.text
                            class="w-full"
                            wire:model="form.name"
                            name="name"
                            id="name"
                            placeholder="{{ __('crud.orders.inputs.name.placeholder') }}"
                        />
                        <x-ui.input.error for="form.name" />
                    </div>

                    <div class="w-full">
                        <x-ui.label for="status"
                            >{{ __('crud.orders.inputs.status.label')
                            }}</x-ui.label
                        >
                        <x-ui.input.text
                            class="w-full"
                            wire:model="form.status"
                            name="status"
                            id="status"
                            placeholder="{{ __('crud.orders.inputs.status.placeholder') }}"
                        />
                        <x-ui.input.error for="form.status" />
                    </div>
                </div>

                <div
                    class="flex justify-between mt-4 border-t border-gray-50 bg-gray-50 p-4"
                >
                    <div>
                        <!-- Other buttons here -->
                    </div>
                    <div>
                        <x-ui.button type="submit">Save</x-ui.button>
                    </div>
                </div>
            </form>
        </div>
    </x-ui.modal>

    {{-- Delete Modal --}}
    <x-ui.modal.confirm wire:model="confirmingOrderDeletion">
        <x-slot name="title"> {{ __('Delete') }} </x-slot>

        <x-slot name="content"> {{ __('Are you sure?') }} </x-slot>

        <x-slot name="footer">
            <x-ui.button
                wire:click="$toggle('confirmingOrderDeletion')"
                wire:loading.attr="disabled"
            >
                {{ __('Cancel') }}
            </x-ui.button>

            <x-ui.button.danger
                class="ml-3"
                wire:click="deleteOrder({{ $deletingOrder }})"
                wire:loading.attr="disabled"
            >
                {{ __('Delete') }}
            </x-ui.button.danger>
        </x-slot>
    </x-ui.modal.confirm>

    {{-- Index Table --}}
    <x-ui.container.table>
        <x-ui.table>
            <x-slot name="head">
                <x-ui.table.header
                    for-detailCrud
                    wire:click="sortBy('warehouse_id')"
                    >{{ __('crud.orders.inputs.warehouse_id.label')
                    }}</x-ui.table.header
                >
                <x-ui.table.header for-detailCrud wire:click="sortBy('name')"
                    >{{ __('crud.orders.inputs.name.label')
                    }}</x-ui.table.header
                >
                <x-ui.table.header for-detailCrud wire:click="sortBy('status')"
                    >{{ __('crud.orders.inputs.status.label')
                    }}</x-ui.table.header
                >
                <x-ui.table.action-header>Actions</x-ui.table.action-header>
            </x-slot>

            <x-slot name="body">
                @forelse ($detailOrders as $order)
                <x-ui.table.row wire:loading.class.delay="opacity-75">
                    <x-ui.table.column for-detailCrud
                        >{{ $order->warehouse_id }}</x-ui.table.column
                    >
                    <x-ui.table.column for-detailCrud
                        >{{ $order->name }}</x-ui.table.column
                    >
                    <x-ui.table.column for-detailCrud
                        >{{ $order->status }}</x-ui.table.column
                    >
                    <x-ui.table.action-column>
                        @can('update', $order)
                        <x-ui.action wire:click="editOrder({{ $order->id }})"
                            >Edit</x-ui.action
                        >
                        @endcan @can('delete', $order)
                        <x-ui.action.danger
                            wire:click="confirmOrderDeletion({{ $order->id }})"
                            >Delete</x-ui.action.danger
                        >
                        @endcan
                    </x-ui.table.action-column>
                </x-ui.table.row>
                @empty
                <x-ui.table.row>
                    <x-ui.table.column colspan="4"
                        >No {{ __('crud.orders.collectionTitle') }} found.</x-ui.table.column
                    >
                </x-ui.table.row>
                @endforelse
            </x-slot>
        </x-ui.table>

        <div class="mt-2">{{ $detailOrders->links() }}</div>
    </x-ui.container.table>
</div>
