<?php

namespace App\Filament\Resources\Panel\OrderResource\RelationManagers;

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
use App\Filament\Resources\Panel\OrderResource;
use Filament\Resources\RelationManagers\RelationManager;

class OrderItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'orderItems';

    protected static ?string $recordTitleAttribute = 'name';

    public function form(Form $form): Form
    {
        return $form->schema([
            Grid::make(['default' => 1])->schema([
                TextInput::make('name')
                    ->required()
                    ->string()
                    ->autofocus(),

                TextInput::make('barcode')
                    ->required()
                    ->string()
                    ->autofocus(),

                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->step(1),
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
                TextColumn::make('price')->searchable(),
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
