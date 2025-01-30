<?php

namespace App\Filament\Resources\Panel\MaintenanceDepartmentResource\Widgets;

use App\Filament\Resources\Panel\MaintenanceDepartmentResource\Pages\ListMaintenanceDepartments;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class Overview extends BaseWidget
{
    use InteractsWithPageTable;

    protected function getTablePage(): string
    {
        return ListMaintenanceDepartments::class;
    }
    protected function getStats(): array
    {
        return [
            Stat::make('Count', $this->getPageTableQuery()->count()),
            Stat::make('Internal', $this->getPageTableQuery()->where('type','internal')->count()),
            Stat::make('External', $this->getPageTableQuery()->where('type','external')->count()),
           
            ];
    }
}
