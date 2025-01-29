<?php

namespace App\Filament\Resources\Panel\DamagedResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\Panel\DamagedResource;

class EditDamaged extends EditRecord
{
    protected static string $resource = DamagedResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\DeleteAction::make()];
    }
}
