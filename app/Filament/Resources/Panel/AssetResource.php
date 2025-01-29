<?php

namespace App\Filament\Resources\Panel;

use Filament\Forms;
use Filament\Tables;
use App\Models\Asset;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Livewire\Component;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\Panel\AssetResource\Pages;
use App\Filament\Resources\Panel\AssetResource\RelationManagers;

class AssetResource extends Resource
{
    protected static ?string $model = Asset::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    protected static ?int $navigationSort = 5;

    protected static ?string $navigationGroup = 'Stock Management';

    public static function getModelLabel(): string
    {
        return __('crud.assets.itemTitle');
    }

    public static function getPluralModelLabel(): string
    {
        return __('crud.assets.collectionTitle');
    }

    public static function getNavigationLabel(): string
    {
        return __('crud.assets.collectionTitle');
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

                    Select::make('warehouse_id')
                        ->required()
                        ->relationship('warehouse', 'name')
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
                TextColumn::make('barcode')->searchable(),
                ImageColumn::make('barcode_image'),
                TextColumn::make('name')->searchable(),

                TextColumn::make('status')
                    ->badge()
                    ->color('success'),
                TextColumn::make('user.name'),

            ])
            ->filters([
                SelectFilter::make('warehouse_id')
                    ->relationship('warehouse', 'name'),
                SelectFilter::make('user_id')
                    ->relationship('user', 'name'),
            ], FiltersLayout::AboveContent)
            ->filtersFormColumns(2)
            ->actions([
                // Tables\Actions\EditAction::make(),
                // Tables\Actions\ViewAction::make(),
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
                    ->iconButton()
                    ->icon('heroicon-m-wrench-screwdriver')
                    ->tooltip('Send to Maintenance Departments'),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
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
            'index' => Pages\ListAssets::route('/'),
            'create' => Pages\CreateAsset::route('/create'),
            'view' => Pages\ViewAsset::route('/{record}'),
            'edit' => Pages\EditAsset::route('/{record}/edit'),
        ];
    }
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::query()->where('status', 'asset')->count();
    }
    public static function getEloquentQuery(): Builder
    {
        return static::getModel()::query()->where('status', 'asset');
    }
}
