<?php

namespace App\Filament\Resources\Panel\OrderResource\Pages;

use App\Filament\Resources\Panel\OrderResource\Widgets\Overview;
use Filament\Actions;
use Filament\Pages\Concerns\ExposesTableToWidgets;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\Panel\OrderResource;

class ListOrders extends ListRecords
{
    use ExposesTableToWidgets;
    protected static string $resource = OrderResource::class;

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
