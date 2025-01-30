<?php

namespace App\Filament\Resources\Panel;

use App\Models\MaintenanceDepartment;
use App\Models\MaintenanceItem;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Textarea;
use Filament\Tables;
use App\Models\Item;
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
use App\Filament\Resources\Panel\ItemResource\Pages;
use App\Filament\Resources\Panel\ItemResource\RelationManagers;

class ItemResource extends Resource
{
    protected static ?string $model = Item::class;

    protected static ?string $navigationIcon = 'heroicon-o-archive-box';

    protected static ?int $navigationSort = 4;

    protected static ?string $navigationGroup = 'Stock Management';

    public static function getModelLabel(): string
    {
        return __('crud.items.itemTitle');
    }

    public static function getPluralModelLabel(): string
    {
        return __('crud.items.collectionTitle');
    }

    public static function getNavigationLabel(): string
    {
        return __('crud.items.collectionTitle');
    }

    public static function getEloquentQuery(): Builder
    {
        return static::getModel()::query()->where('status','in_where_house');
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
            ])
            ->filters([
                

                SelectFilter::make('warehouse_id')
                    ->relationship('warehouse', 'name'),

            ])

            ->actions([
                // Tables\Actions\EditAction::make(),
                // Tables\Actions\ViewAction::make(),
                Action::make('assign_to_user')
                ->button()
                ->color('success')
                    ->icon('heroicon-m-user-circle')
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
                    ->tooltip('Assign to user'),
                    Action::make('send_to_maintenance_departments')
                    ->iconButton()
                    ->icon('heroicon-m-wrench-screwdriver')
                    ->tooltip('Send to Maintenance Departments')
                    ->form(
                        [
                            Select::make('maintenance_department_id')
                            ->required()
                            ->searchable()
                            ->options(function () {
                                return MaintenanceDepartment::all()
                                    ->pluck('name', 'id');
                            })
                            ->placeholder('Select a Department'),
                            Textarea::make('note'),
                        ]
                    )
                    
                    ->action(function ($record, array $data) {
                        // Update the status when the action is triggered
                        $record->status = 'in_maintenance';
                        $record->maintenance_department_id = $data['maintenance_department_id'];

                        $item = new MaintenanceItem();
                        $item->asset_id = $record->id;
                        $item->item_id = $record->id;
                        $item->damaged_id  = $record->id;
                        $item->maintenance_department_id   = $record->maintenance_department_id;
                        $item->status   = $record->status;
                        $item->note   = $data['note'];
                        $item->save();

                        $record->save();
                    })
                    // Action::make('damged')
                    // ->iconButton()
                    // ->color('danger')
                    // ->icon('heroicon-m-trash')
                    // ->tooltip('Mark as Damged')
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
            'index' => Pages\ListItems::route('/'),
            'create' => Pages\CreateItem::route('/create'),
            'view' => Pages\ViewItem::route('/{record}'),
            'edit' => Pages\EditItem::route('/{record}/edit'),
        ];
    }
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::query()->where('status','in_where_house')->count();
    }
}
