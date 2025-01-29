<?php

namespace App\Filament\Resources\Panel\OrderResource\Pages;

use App\Models\Item;
use Filament\Actions;
use Filament\Forms\Components\Select;
use Filament\Pages\Actions\Action;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\Panel\OrderResource;

class EditOrder extends EditRecord
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Action::make('change_status')
            ->color('success')
                ->icon('heroicon-m-arrow-path')
                ->tooltip('Change Status')
                ->form([
                    // Status dropdown
                    Select::make('status')
                        ->label('Status')
                        ->options(function ($record) {
                            // Base options
                            $options = [
                                'Waiting' => 'Waiting',
                                'Approve' => 'Approve',
                                'Reject' => 'Reject',
                            ];



                            return $options;
                        })
                        ->required()
                        ->placeholder('Select a status')
                        ->default(fn($record) => $record->status ?? 'pending')
                        ->reactive(),




                ])
                ->action(function ($record, array $data) {
                    // Update the status when the action is triggered
                    $record->status = $data['status'];
                    $record->save();
                    if ($record->status == 'Approve') {
                        foreach ($record->orderItems as $asset) {
                            $item = new Item();
                            $item->name = $asset->name;
                            $item->barcode = $asset->barcode;
                            $item->barcode_image = $asset->barcode_image;
                            $item->status = 'in_where_house';
                            $item->warehouse_id = $record->warehouse_id;
                            $item->save();

                        }
                    }


                })
        ];
    }
}
