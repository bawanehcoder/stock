<?php

namespace App\Filament\Resources\Panel\OrderResource\Widgets;

use App\Filament\Resources\Panel\OrderResource\Pages\ListOrders;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class Overview extends BaseWidget
{
    use InteractsWithPageTable;

    protected function getTablePage(): string
    {
        return ListOrders::class;
    }
    protected function getStats(): array
    {
        return [
            Stat::make('Waiting', $this->getPageTableQuery()->where('status', 'Waiting')->count())
            ->color('info'),
            Stat::make('Approved', $this->getPageTableQuery()->where('status', 'Approve')->count())
            ->color('success'),
            Stat::make('Rejected', $this->getPageTableQuery()->where('status', 'Reject')->count())
            ->color('danger'),
        ];
    }
}
