<?php

namespace App\Filament\Resources\Panel;

use App\Filament\Resources\Panel\MaintenanceDepartmentResource\Widgets\Overview;
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

    protected static ?string $navigationIcon = 'heroicon-o-wrench-screwdriver';

    protected static ?int $navigationSort = 7;

    protected static ?string $navigationGroup = 'Maintenance';

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
                        ->options(options: [
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
                TextColumn::make('name')->searchable(),

                TextColumn::make('location'),

                TextColumn::make('type')->badge()
                ->colors([
                    'success' => 'internal',
                    'danger' => 'external',
                ]),
                TextColumn::make('users.count')->label('Emplyess Count')->default(0)->badge()
                    ->getStateUsing(function ($record) {
                        return $record->users->count();
                    }),
                TextColumn::make('items.count')->default(0)->label('Items Count')->badge()
                    ->getStateUsing(function ($record) {
                        return $record->maintenanceItems->count();
                    }),
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
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getWidgets(): array
    {
        return [
            Overview::class,
        ];
    }
}
