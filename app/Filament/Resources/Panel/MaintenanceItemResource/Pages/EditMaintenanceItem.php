<?php

namespace App\Filament\Resources\Panel\MaintenanceItemResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\Panel\MaintenanceItemResource;

class EditMaintenanceItem extends EditRecord
{
    protected static string $resource = MaintenanceItemResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\DeleteAction::make()];
    }
}
