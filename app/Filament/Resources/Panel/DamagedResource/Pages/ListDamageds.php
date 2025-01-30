<?php

namespace App\Filament\Resources\Panel\DamagedResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\Panel\DamagedResource;

class ListDamageds extends ListRecords
{
    protected static string $resource = DamagedResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
