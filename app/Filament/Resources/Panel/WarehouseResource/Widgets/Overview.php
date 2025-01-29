<?php

namespace App\Filament\Resources\Panel\WarehouseResource\Widgets;

use App\Filament\Resources\Panel\WarehouseResource\Pages\ListWarehouses;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class Overview extends BaseWidget
{
    use InteractsWithPageTable;

    protected function getTablePage(): string
    {
        return ListWarehouses::class;
    }
    protected function getStats(): array
    {
        return [
            Stat::make('Count', $this->getPageTableQuery()->count()),
            Stat::make('Employees Count', $this->getPageTableQuery()->get()->sum(
                function ($model) {
                    return $model->users()->count();
                }
            )),
            Stat::make('Items Count', $this->getPageTableQuery()->get()->sum(
                function ($model) {
                    return $model->items()->count();
                }
            )),
            ];
    }
}
