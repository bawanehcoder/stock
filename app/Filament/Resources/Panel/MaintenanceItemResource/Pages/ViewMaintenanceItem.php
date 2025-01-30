<?php

namespace App\Filament\Resources\Panel\MaintenanceItemResource\Pages;

use App\Models\MaintenanceItem;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\Panel\MaintenanceItemResource;

class ViewMaintenanceItem extends ViewRecord
{
    protected static string $resource = MaintenanceItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('mark_as_fexed')
                ->button()
                ->color('success')
                ->icon('heroicon-m-wrench-screwdriver')
                ->form([
                    Textarea::make('note')
                        ->required()
                        ->autofocus(),
                ])
                ->action(function ($record, array $data) {
                    if ($record->user_id == null) {
                        $record->status = 'in_where_house';
                    } else {
                        $record->status = 'asset';
                    }

                    $item = new MaintenanceItem();
                    $item->asset_id = $record->id;
                    $item->item_id = $record->id;
                    $item->damaged_id = $record->id;
                    $item->maintenance_department_id = $record->maintenance_department_id;
                    $item->status = $record->status;
                    $item->note = $data['note'];
                    $item->save();

                    $record->save();
                })
                ->tooltip('Mark as Fixed'),
            Action::make('damged')
                // ->iconButton()
                ->color('danger')
                ->icon('heroicon-m-trash')
                ->tooltip('Mark as Damged')
                ->label('Mark as Damged')
                ->form([
                    Textarea::make('note')
                        ->required()
                        ->autofocus(),
                ])
                ->action(function ($record, array $data) {

                    $record->status = 'damaged';
                    $record->save();

                    $item = new MaintenanceItem();
                    $item->asset_id = $record->id;
                    $item->item_id = $record->id;
                    $item->damaged_id = $record->id;
                    $item->maintenance_department_id = $record->maintenance_department_id;
                    $item->status = $record->status;
                    $item->note = $data['note'];
                    $item->save();
                })
        ];
    }
}
