<?php

namespace App\Filament\Resources\Panel;

use App\Filament\Resources\Panel\OrderResource\Widgets\Overview;
use Filament\Forms;
use Filament\Tables;
use App\Models\Order;
use Filament\Tables\Actions\Action;
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
use App\Filament\Resources\Panel\OrderResource\Pages;
use App\Filament\Resources\Panel\OrderResource\RelationManagers;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationGroup = 'Admin';

    public static function getModelLabel(): string
    {
        return __('crud.orders.itemTitle');
    }

    public static function getPluralModelLabel(): string
    {
        return __('crud.orders.collectionTitle');
    }

    public static function getNavigationLabel(): string
    {
        return __('crud.orders.collectionTitle');
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make()->schema([
                Grid::make(['default' => 2])->schema([
                    Select::make('supplier_id')
                        ->required()
                        ->relationship('supplier', 'name')
                        ->searchable()
                        ->preload()
                        ->native(false),

                    Select::make('warehouse_id')
                        ->required()
                        ->relationship('warehouse', 'name')
                        ->searchable()
                        ->preload()
                        ->native(false),

                    TextInput::make('name')
                        ->required()
                        ->string(),

                    TextInput::make('status')
                        ->required()
                        ->string(),
                ]),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->poll('60s')
            ->columns([
                TextColumn::make('supplier.name'),

                TextColumn::make('warehouse.name'),

                TextColumn::make('name'),

                TextColumn::make('status')
                    ->badge()
                    ->color(
                        fn(string $state): string => match ($state) {
                            'Waiting' => 'info',
                            'Approve' => 'success',
                            'Reject' => 'danger',
                        }
                    ),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'Waiting' => 'Waiting',
                        'Approve' => 'Approve',
                        'Reject' => 'Reject',
                    ]),
                SelectFilter::make('supplier_id')
                    ->relationship('supplier', 'name'),
                SelectFilter::make('warehouse_id')
                    ->relationship('warehouse', 'name'),
            ], FiltersLayout::AboveContent)
            ->filtersFormColumns(3)
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
                Action::make('change_status')
                ->iconButton()
                ->icon('heroicon-m-arrow-path')
                ->tooltip('Change Status')
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
        return [RelationManagers\OrderItemsRelationManager::class];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'view' => Pages\ViewOrder::route('/{record}'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
    public static function getWidgets(): array
    {
        return [
            Overview::class,
        ];
    }
}
