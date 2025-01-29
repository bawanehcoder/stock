<?php

namespace App\Filament\Resources\Panel\MaintenanceItemResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\Panel\MaintenanceItemResource;

class ViewMaintenanceItem extends ViewRecord
{
    protected static string $resource = MaintenanceItemResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\EditAction::make()];
    }
}
