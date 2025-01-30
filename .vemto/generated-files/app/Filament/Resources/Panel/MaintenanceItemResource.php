<?php

namespace App\Filament\Resources\Panel;

use Filament\Forms;
use Filament\Tables;
use Livewire\Component;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\MaintenanceItem;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\RichEditor;
use App\Filament\Resources\Panel\MaintenanceItemResource\Pages;
use App\Filament\Resources\Panel\MaintenanceItemResource\RelationManagers;

class MaintenanceItemResource extends Resource
{
    protected static ?string $model = MaintenanceItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationGroup = 'Admin';

    public static function getModelLabel(): string
    {
        return __('crud.maintenanceItems.itemTitle');
    }

    public static function getPluralModelLabel(): string
    {
        return __('crud.maintenanceItems.collectionTitle');
    }

    public static function getNavigationLabel(): string
    {
        return __('crud.maintenanceItems.collectionTitle');
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make()->schema([
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

                    Select::make('maintenance_department_id')
                        ->required()
                        ->relationship('maintenanceDepartment', 'name')
                        ->searchable()
                        ->preload()
                        ->native(false),
                ]),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->poll('60s')
            ->columns([
                TextColumn::make('status'),

                TextColumn::make('note')->limit(255),

                TextColumn::make('item.name'),

                TextColumn::make('maintenanceDepartment.name'),
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMaintenanceItems::route('/'),
            'create' => Pages\CreateMaintenanceItem::route('/create'),
            'view' => Pages\ViewMaintenanceItem::route('/{record}'),
            'edit' => Pages\EditMaintenanceItem::route('/{record}/edit'),
        ];
    }
}
