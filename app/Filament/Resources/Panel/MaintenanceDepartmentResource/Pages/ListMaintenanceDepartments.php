<?php

namespace App\Filament\Resources\Panel\MaintenanceDepartmentResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\Panel\MaintenanceDepartmentResource;

class ListMaintenanceDepartments extends ListRecords
{
    protected static string $resource = MaintenanceDepartmentResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\CreateAction::make()];
    }
}
