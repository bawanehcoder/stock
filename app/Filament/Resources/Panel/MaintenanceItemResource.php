<?php

namespace App\Filament\Resources\Panel;

use App\Models\Item;
use App\Models\User;
use Filament\Forms;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\ImageColumn;
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
    protected static ?string $model = Item::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog';

    protected static ?int $navigationSort = 8;

    protected static ?string $navigationGroup = 'Maintenance';

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
                ->color(
                    fn(string $state): string => match ($state) {
                        'in_maintenance' => 'info',
                        'in_where_house' => 'success',
                        'damaged' => 'danger',
                    }
                ),


                TextColumn::make('warehouse.name'),

                TextColumn::make('note')->limit(255)
                ->getStateUsing(function ($record) {
                    return $record->maintenanceItems()->first()->note;
                }),
                TextColumn::make('maintenanceDepartment.name'),

            ])
            ->filters([
                // Tables\Filters\SelectFilter::make('status'),
                // Tables\Filters\SearchFilter::make('name'),
                // Tables\Filters\TextFilter::make('note'),
                // Tables\Filters\SelectFilter::make('warehouse_id'),
                Tables\Filters\SelectFilter::make('maintenance_department_id')
                ->relationship('maintenanceDepartment', 'name')
                // Tables\Filters\SelectFilter::make('asset_id'),
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
                Action::make('mark_as_fexed')
                    ->button()
                    ->color('success')
                    ->icon('heroicon-m-wrench-screwdriver')
                    ->form(
                        [
                            Select::make('user_id')
                                ->required()
                                ->searchable()
                                ->options(function () {
                                    return User::all()
                                        ->pluck('name', 'id');
                                })
                                ->placeholder('Select a User')
                        ]
                    )
                    ->action(function ($record, array $data) {
                        // Update the status when the action is triggered
                        $record->status = 'asset';
                        $record->user_id = $data['user_id'];
                        $record->save();
                    })
                    ->tooltip('Mark as Fixed'),
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
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
