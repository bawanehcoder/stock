<?php

namespace App\Filament\Resources\Panel\WarehouseResource\RelationManagers;

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
use App\Filament\Resources\Panel\WarehouseResource;
use Filament\Resources\RelationManagers\RelationManager;

class ItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    protected static ?string $recordTitleAttribute = 'name';

    public function form(Form $form): Form
    {
        return $form->schema([
            Grid::make(['default' => 1])->schema([
                TextInput::make('name')
                    ->required()
                    ->string()
                    ->autofocus(),

                Select::make('status')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->native(false)
                    ->options([
                        'in_where_house' => 'In where house',
                        'asset' => 'Asset',
                        'in_maintenance' => 'In maintenance',
                        'damaged' => 'Damaged',
                    ]),

                Select::make('user_id')
                    ->required()
                    ->relationship('user', 'name')
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
                    }
                ),

                
            ])
            ->filters([])
            ->headerActions([Tables\Actions\CreateAction::make()])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
