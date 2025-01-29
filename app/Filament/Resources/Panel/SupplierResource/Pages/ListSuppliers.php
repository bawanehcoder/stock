<?php

namespace App\Filament\Resources\Panel\SupplierResource\Pages;

use App\Filament\Resources\Panel\SupplierResource\Widgets\Overview;
use Filament\Actions;
use Filament\Pages\Concerns\ExposesTableToWidgets;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\Panel\SupplierResource;

class ListSuppliers extends ListRecords
{
    use ExposesTableToWidgets;
    protected static string $resource = SupplierResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\CreateAction::make()];
    }
    protected function getHeaderWidgets(): array
    {
        return [
            Overview::class,
        ];
    }
}
