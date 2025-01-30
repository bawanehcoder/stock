<?php

namespace App\Filament\Resources\Panel\AssetResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\Panel\AssetResource;
use App\Models\MaintenanceDepartment;
use App\Models\MaintenanceItem;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Pages\Actions\Action;

class ViewAsset extends ViewRecord
{
    protected static string $resource = AssetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('return_to_warehouse')
                    ->button()
                    ->color('success')
                    ->icon('heroicon-m-home-modern')
                    ->requiresConfirmation()
                    
                    ->action(function ($record, array $data) {
                        // Update the status when the action is triggered
                        $record->status = 'in_where_house';
                        $record->user_id = null;
                        $record->save();
                    })
                    ->tooltip('Return to warehouse'),
                Action::make('send_to_maintenance_departments')
                    // ->iconButton()
                    ->icon('heroicon-m-wrench-screwdriver')
                    ->tooltip('Send to Maintenance Departments')
                    ->label('Send to Maintenance Departments')
                    ->form(
                        [
                            Select::make('maintenance_department_id')
                            ->required()
                            ->searchable()
                            ->options(function () {
                                return MaintenanceDepartment::all()
                                    ->pluck('name', 'id');
                            })
                            ->placeholder('Select a Department'),
                            Textarea::make('note'),
                        ]
                    )
                    
                    ->action(function ($record, array $data) {
                        // Update the status when the action is triggered
                        $record->status = 'in_maintenance';
                        $record->maintenance_department_id = $data['maintenance_department_id'];

                        $item = new MaintenanceItem();
                        $item->asset_id = $record->id;
                        $item->item_id = $record->id;
                        $item->damaged_id  = $record->id;
                        $item->maintenance_department_id   = $record->maintenance_department_id;
                        $item->status   = $record->status;
                        $item->note   = $data['note'];
                        $item->save();

                        $record->save();
                    })
        ];
    }
}
