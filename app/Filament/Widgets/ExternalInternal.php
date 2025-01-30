<?php

namespace App\Filament\Widgets;

use App\Models\MaintenanceDepartment;
use Filament\Widgets\ChartWidget;

class ExternalInternal extends ChartWidget
{
    protected static ?string $heading = 'External/Internal';

    protected static ?string $maxHeight = "250px";

    protected static ?int $sort = 2;


    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'data' => [MaintenanceDepartment::where('type','external')->get()->count(),
                    MaintenanceDepartment::where('type','internal')->get()->count()],
                    "backgroundColor" => [
                        'rgb(255, 205, 86)',
                        'rgb(255, 99, 132)',
                    ],
                    'fill' => 'start',
                ],
            ],
            'labels' => ['External', 'Internal'],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
