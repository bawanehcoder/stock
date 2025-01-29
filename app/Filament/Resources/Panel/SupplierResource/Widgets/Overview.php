<?php

namespace App\Filament\Resources\Panel\SupplierResource\Widgets;

use App\Filament\Resources\Panel\SupplierResource\Pages\ListSuppliers;
use App\Models\Supplier;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class Overview extends BaseWidget
{

    use InteractsWithPageTable;

    protected function getTablePage(): string
    {
        return ListSuppliers::class;
    }
    protected function getStats(): array
    {
        return [
            Stat::make('Supplier Count', $this->getPageTableQuery()->count()),
            Stat::make('Best Suppliers', $this->getPageTableQuery()->count()),
            Stat::make('Order Count', $this->getPageTableQuery()->count()),
        ];
    }
}
