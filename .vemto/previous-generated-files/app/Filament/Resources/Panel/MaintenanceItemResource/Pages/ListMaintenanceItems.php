<?php

namespace App\Filament\Resources\Panel\MaintenanceItemResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\Panel\MaintenanceItemResource;

class ListMaintenanceItems extends ListRecords
{
    protected static string $resource = MaintenanceItemResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\CreateAction::make()];
    }
}
