<?php

namespace App\Filament\Resources\Panel\ItemResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\RichEditor;
use App\Filament\Resources\Panel\ItemResource;
use Filament\Resources\RelationManagers\RelationManager;

class MaintenanceItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'maintenanceItems';

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

                Select::make('maintenance_department_id')
                    ->required()
                    ->relationship('maintenanceDepartment', 'name')
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
                TextColumn::make('status')->badge(),

                TextColumn::make('note')->limit(255),

                TextColumn::make('maintenanceDepartment.name'),
                TextColumn::make('created_at'),
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
