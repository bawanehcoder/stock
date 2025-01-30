<?php

namespace App\Filament\Widgets;

use App\Models\Asset;
use App\Models\Item;
use Filament\Widgets\ChartWidget;

class AssetsItems extends ChartWidget
{
    protected static ?string $heading = 'Assets/Items';

    protected static ?string $maxHeight = "250px";

    protected static ?int $sort = 1;


    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'data' => [
                        Asset::where('status', 'asset')->get()->count(),
                        Item::where('user_id', 'null')->get()->count()
                    ],
                    "backgroundColor" => [
                        'rgb(255, 205, 86)',
                        'rgb(255, 99, 132)',
                    ],
                    'fill' => 'start',
                ],
            ],
            'labels' => ['Assets', 'Items'],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
