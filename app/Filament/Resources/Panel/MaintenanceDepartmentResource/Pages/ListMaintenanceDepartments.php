<?php

namespace App\Filament\Resources\Panel\MaintenanceDepartmentResource\Pages;

use App\Filament\Resources\Panel\MaintenanceDepartmentResource\Widgets\Overview;
use Filament\Actions;
use Filament\Pages\Concerns\ExposesTableToWidgets;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\Panel\MaintenanceDepartmentResource;
use Filament\Resources\Pages\ListRecords\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListMaintenanceDepartments extends ListRecords
{
    use ExposesTableToWidgets;
    protected static string $resource = MaintenanceDepartmentResource::class;

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

    public function getTabs(): array
{
    return [
        'all' => Tab::make(),
        'internal' => Tab::make()
            ->modifyQueryUsing(fn (Builder $query) => $query->where('type', 'internal')),
        'external' => Tab::make()
            ->modifyQueryUsing(fn (Builder $query) => $query->where('type', 'external')),
    ];
}
}
