<?php

namespace App\Filament\Resources\Panel\MaintenanceDepartmentResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\RichEditor;
use Filament\Resources\RelationManagers\RelationManager;
use App\Filament\Resources\Panel\MaintenanceDepartmentResource;

class MaintenanceItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    protected static ?string $recordTitleAttribute = 'status';

    public function form(Form $form): Form
    {
        return $form->schema([
            Grid::make(['default' => 1])->schema([
                TextInput::make('status')
                    ->required()
                    ->string()
                    ->autofocus(),

                RichEditor::make('note')
                    ->required()
                    ->string()
                    ->fileAttachmentsVisibility('public'),

                Select::make('item_id')
                    ->required()
                    ->relationship('item', 'name')
                    ->searchable()
                    ->preload()
                    ->native(false),
            ]),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('barcode')->searchable(),
                ImageColumn::make('barcode_image'),
                TextColumn::make('name')->searchable(),

                TextColumn::make('status')
                    ->badge()
                    ->color(
                        fn(string $state): string => match ($state) {
                            'in_maintenance' => 'info',
                            'in_where_house' => 'success',
                            'damaged' => 'danger',
                            'asset' => 'success',
                        }
                    ),


                TextColumn::make('warehouse.name'),

                TextColumn::make('note')->limit(255)
                    ->getStateUsing(function ($record) {
                        return $record->maintenanceItems()->latest()->first()->note;
                    }),
                TextColumn::make('maintenanceDepartment.name'),
            ])
            ->filters([])
            ->headerActions([])
            ->actions([
               
            ])
            ->bulkActions([
               
            ]);
    }
}
