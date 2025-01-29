<?php

namespace App\Filament\Resources\Panel\DamagedResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\Panel\DamagedResource;

class ViewDamaged extends ViewRecord
{
    protected static string $resource = DamagedResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\EditAction::make()];
    }
}
