<?php

namespace App\Filament\Resources\Panel;

use Filament\Forms;
use Filament\Tables;
use Livewire\Component;
use App\Models\Damaged;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\Panel\DamagedResource\Pages;
use App\Filament\Resources\Panel\DamagedResource\RelationManagers;

class DamagedResource extends Resource
{
    protected static ?string $model = Damaged::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationGroup = 'Admin';

    public static function getModelLabel(): string
    {
        return __('crud.damageds.itemTitle');
    }

    public static function getPluralModelLabel(): string
    {
        return __('crud.damageds.collectionTitle');
    }

    public static function getNavigationLabel(): string
    {
        return __('crud.damageds.collectionTitle');
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

                    Select::make('warehouse_id')
                        ->required()
                        ->relationship('warehouse', 'name')
                        ->searchable()
                        ->preload()
                        ->native(false),

                    Select::make('user_id')
                        ->nullable()
                        ->relationship('user', 'name')
                        ->searchable()
                        ->preload()
                        ->native(false),

                    TextInput::make('barcode')
                        ->nullable()
                        ->string(),

                    TextInput::make('barcode_image')
                        ->nullable()
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
                TextColumn::make('name'),

                TextColumn::make('status'),

                TextColumn::make('warehouse.name'),

                TextColumn::make('user.name'),

                TextColumn::make('barcode'),

                TextColumn::make('barcode_image'),
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
            'index' => Pages\ListDamageds::route('/'),
            'create' => Pages\CreateDamaged::route('/create'),
            'view' => Pages\ViewDamaged::route('/{record}'),
            'edit' => Pages\EditDamaged::route('/{record}/edit'),
        ];
    }
}
