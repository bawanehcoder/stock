<?php

namespace App\Filament\Resources\Panel\WarehouseResource\Pages;

use App\Filament\Resources\Panel\WarehouseResource\Widgets\Overview;
use Filament\Actions;
use Filament\Pages\Concerns\ExposesTableToWidgets;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\Panel\WarehouseResource;

class ListWarehouses extends ListRecords
{
    use ExposesTableToWidgets;

    protected static string $resource = WarehouseResource::class;

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
