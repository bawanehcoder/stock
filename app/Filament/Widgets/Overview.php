<?php

namespace App\Filament\Widgets;

use App\Models\Asset;
use App\Models\Damaged;
use App\Models\Item;
use App\Models\MaintenanceItem;
use App\Models\Order;
use App\Models\Supplier;
use App\Models\User;
use App\Models\Warehouse;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Spatie\Permission\Models\Role;

class Overview extends BaseWidget
{
    protected static ?int $sort = 0;

    protected function getStats(): array
    {
        return [
            Stat::make('Suppliers', Supplier::all()->count()),
            Stat::make('Warehouse', Warehouse::all()->count()),
            Stat::make('Employees', User::all()->count()),
            Stat::make('Orders', value: Order::all()->count()),
            Stat::make('Items', Item::where('user_id','null')->get()->count()),
            Stat::make('Assets', Asset::where('status','asset')->get()->count()),
            Stat::make('Damaged Items', Damaged::where('status','damaged')->get()->count()),
            Stat::make('Items in Maintenance', MaintenanceItem::where('status','Items in Maintenance')->get()->count()),
            Stat::make('Roles', Role::all()->count()),
            
        ];
    }
}
