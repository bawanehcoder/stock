<?php

namespace App\Filament\Resources\Panel;

use Filament\Forms;
use Filament\Tables;
use Livewire\Component;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use App\Models\MaintenanceDepartment;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\Panel\MaintenanceDepartmentResource\Pages;
use App\Filament\Resources\Panel\MaintenanceDepartmentResource\RelationManagers;

class MaintenanceDepartmentResource extends Resource
{
    protected static ?string $model = MaintenanceDepartment::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationGroup = 'Admin';

    public static function getModelLabel(): string
    {
        return __('crud.maintenanceDepartments.itemTitle');
    }

    public static function getPluralModelLabel(): string
    {
        return __('crud.maintenanceDepartments.collectionTitle');
    }

    public static function getNavigationLabel(): string
    {
        return __('crud.maintenanceDepartments.collectionTitle');
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make()->schema([
                Grid::make(['default' => 1])->schema([
                    TextInput::make('name')
                        ->required()
                        ->string()
                        ->autofocus(),

                    TextInput::make('location')
                        ->required()
                        ->string(),

                    Select::make('type')
                        ->required()
                        ->searchable()
                        ->preload()
                        ->native(false)
                        ->options([
                            'internal' => 'Internal',
                            'external' => 'External',
                        ]),
                ]),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->poll('60s')
            ->columns([
                TextColumn::make('name'),

                TextColumn::make('location'),

                TextColumn::make('type'),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('id', 'desc');
    }

    public static function getRelations(): array
    {
        return [RelationManagers\MaintenanceItemsRelationManager::class];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMaintenanceDepartments::route('/'),
            'create' => Pages\CreateMaintenanceDepartment::route('/create'),
            'view' => Pages\ViewMaintenanceDepartment::route('/{record}'),
            'edit' => Pages\EditMaintenanceDepartment::route('/{record}/edit'),
        ];
    }
}
