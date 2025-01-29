<?php

return [
    'suppliers' => [
        'itemTitle' => 'Supplier',
        'collectionTitle' => 'Suppliers',
        'inputs' => [
            'name' => [
                'label' => 'Name',
                'placeholder' => 'Name',
            ],
            'phone' => [
                'label' => 'Phone',
                'placeholder' => 'Phone',
            ],
            'location' => [
                'label' => 'Location',
                'placeholder' => 'Location',
            ],
        ],
        'filament' => [
            'name' => [
                'helper_text' => '',
                'label' => '',
                'description' => '',
            ],
            'phone' => [
                'helper_text' => '',
                'label' => '',
                'description' => '',
            ],
            'location' => [
                'helper_text' => '',
                'label' => '',
                'description' => '',
            ],
        ],
    ],
    'orders' => [
        'itemTitle' => 'Order',
        'collectionTitle' => 'Orders',
        'inputs' => [
            'warehouse_id' => [
                'label' => 'Warehouse id',
                'placeholder' => 'Warehouse id',
            ],
            'name' => [
                'label' => 'Name',
                'placeholder' => 'Name',
            ],
            'status' => [
                'label' => 'Status',
                'placeholder' => 'Status',
            ],
            'supplier_id' => [
                'label' => 'Supplier id',
                'placeholder' => 'Supplier id',
            ],
        ],
        'filament' => [
            'warehouse_id' => [
                'helper_text' => '',
                'loading_message' => '',
                'no_result_message' => '',
                'search_message' => '',
                'label' => '',
            ],
            'name' => [
                'helper_text' => '',
                'label' => '',
                'description' => '',
            ],
            'status' => [
                'helper_text' => '',
                'label' => '',
                'description' => '',
            ],
            'supplier_id' => [
                'helper_text' => '',
                'loading_message' => '',
                'no_result_message' => '',
                'search_message' => '',
                'label' => '',
            ],
        ],
    ],
    'orderItems' => [
        'itemTitle' => 'Order Item',
        'collectionTitle' => 'Order Items',
        'inputs' => [
            'name' => [
                'label' => 'Name',
                'placeholder' => 'Name',
            ],
            'status' => [
                'label' => 'Status',
                'placeholder' => 'Status',
            ],
            'price' => [
                'label' => 'Price',
                'placeholder' => 'Price',
            ],
        ],
        'filament' => [
            'name' => [
                'helper_text' => '',
                'label' => '',
                'description' => '',
            ],
            'status' => [
                'helper_text' => '',
                'loading_message' => '',
                'no_result_message' => '',
                'search_message' => '',
                'label' => '',
            ],
            'price' => [
                'helper_text' => '',
                'label' => '',
                'description' => '',
            ],
        ],
    ],
    'warehouses' => [
        'itemTitle' => 'Warehouse',
        'collectionTitle' => 'Warehouses',
        'inputs' => [
            'name' => [
                'label' => 'Name',
                'placeholder' => 'Name',
            ],
            'location' => [
                'label' => 'Location',
                'placeholder' => 'Location',
            ],
        ],
        'filament' => [
            'name' => [
                'helper_text' => '',
                'label' => '',
                'description' => '',
            ],
            'location' => [
                'helper_text' => '',
                'label' => '',
                'description' => '',
            ],
        ],
    ],
    'items' => [
        'itemTitle' => 'Item',
        'collectionTitle' => 'Items',
        'inputs' => [
            'name' => [
                'label' => 'Name',
                'placeholder' => 'Name',
            ],
            'status' => [
                'label' => 'Status',
                'placeholder' => 'Status',
            ],
            'user_id' => [
                'label' => 'User id',
                'placeholder' => 'User id',
            ],
            'warehouse_id' => [
                'label' => 'Warehouse id',
                'placeholder' => 'Warehouse id',
            ],
        ],
        'filament' => [
            'name' => [
                'helper_text' => '',
                'label' => '',
                'description' => '',
            ],
            'status' => [
                'helper_text' => '',
                'loading_message' => '',
                'no_result_message' => '',
                'search_message' => '',
                'label' => '',
            ],
            'user_id' => [
                'helper_text' => '',
                'loading_message' => '',
                'no_result_message' => '',
                'search_message' => '',
                'label' => '',
            ],
            'warehouse_id' => [
                'helper_text' => '',
                'loading_message' => '',
                'no_result_message' => '',
                'search_message' => '',
                'label' => '',
            ],
        ],
    ],
    'userWarehouse' => [
        'itemTitle' => 'User Warehouse',
        'collectionTitle' => 'User Warehouse',
    ],
    'maintenanceItems' => [
        'itemTitle' => 'Maintenance Item',
        'collectionTitle' => 'Maintenance Items',
        'inputs' => [
            'status' => [
                'label' => 'Status',
                'placeholder' => 'Status',
            ],
            'note' => [
                'label' => 'Note',
                'placeholder' => 'Note',
            ],
            'maintenance_department_id' => [
                'label' => 'Maintenance department id',
                'placeholder' => 'Maintenance department id',
            ],
            'item_id' => [
                'label' => 'Item id',
                'placeholder' => 'Item id',
            ],
            'asset_id' => [
                'label' => 'Asset id',
                'placeholder' => 'Asset id',
            ],
        ],
        'filament' => [
            'status' => [
                'helper_text' => '',
                'label' => '',
                'description' => '',
            ],
            'note' => [
                'helper_text' => '',
                'label' => '',
            ],
            'maintenance_department_id' => [
                'helper_text' => '',
                'loading_message' => '',
                'no_result_message' => '',
                'search_message' => '',
                'label' => '',
            ],
            'item_id' => [
                'helper_text' => '',
                'loading_message' => '',
                'no_result_message' => '',
                'search_message' => '',
                'label' => '',
            ],
            'asset_id' => [
                'helper_text' => '',
                'loading_message' => '',
                'no_result_message' => '',
                'search_message' => '',
                'label' => '',
            ],
        ],
    ],
    'assets' => [
        'itemTitle' => 'Asset',
        'collectionTitle' => 'Assets',
        'inputs' => [
            'name' => [
                'label' => 'Name',
                'placeholder' => 'Name',
            ],
            'status' => [
                'label' => 'Status',
                'placeholder' => 'Status',
            ],
            'user_id' => [
                'label' => 'User id',
                'placeholder' => 'User id',
            ],
            'warehouse_id' => [
                'label' => 'Warehouse id',
                'placeholder' => 'Warehouse id',
            ],
        ],
        'filament' => [
            'name' => [
                'helper_text' => '',
                'label' => '',
                'description' => '',
            ],
            'status' => [
                'helper_text' => '',
                'loading_message' => '',
                'no_result_message' => '',
                'search_message' => '',
                'label' => '',
            ],
            'user_id' => [
                'helper_text' => '',
                'loading_message' => '',
                'no_result_message' => '',
                'search_message' => '',
                'label' => '',
            ],
            'warehouse_id' => [
                'helper_text' => '',
                'loading_message' => '',
                'no_result_message' => '',
                'search_message' => '',
                'label' => '',
            ],
        ],
    ],
    'maintenanceDepartments' => [
        'itemTitle' => 'Maintenance Department',
        'collectionTitle' => 'Maintenance Departments',
        'inputs' => [
            'name' => [
                'label' => 'Name',
                'placeholder' => 'Name',
            ],
            'location' => [
                'label' => 'Location',
                'placeholder' => 'Location',
            ],
            'type' => [
                'label' => 'Type',
                'placeholder' => 'Type',
            ],
        ],
        'filament' => [
            'name' => [
                'helper_text' => '',
                'label' => '',
                'description' => '',
            ],
            'location' => [
                'helper_text' => '',
                'label' => '',
                'description' => '',
            ],
            'type' => [
                'helper_text' => '',
                'loading_message' => '',
                'no_result_message' => '',
                'search_message' => '',
                'label' => '',
            ],
        ],
    ],
];
