<?php

namespace App\Filament\Resources\Panel\MaintenanceDepartmentResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\Panel\MaintenanceDepartmentResource;

class ViewMaintenanceDepartment extends ViewRecord
{
    protected static string $resource = MaintenanceDepartmentResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\EditAction::make()];
    }
}
