<?php

namespace App\Filament\Resources\Panel\MaintenanceDepartmentResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\Panel\MaintenanceDepartmentResource;

class EditMaintenanceDepartment extends EditRecord
{
    protected static string $resource = MaintenanceDepartmentResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\DeleteAction::make()];
    }
}
