<?php

namespace App\Filament\Resources\Panel;

use Filament\Forms;
use Filament\Tables;
use App\Models\User;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Livewire\Component;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\Panel\EmployeeResource\Pages;
use App\Filament\Resources\Panel\EmployeeResource\RelationManagers;

class EmployeeResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    protected static ?int $navigationSort = 9;

    protected static ?string $navigationGroup = 'Admin';

    public static function getModelLabel(): string
    {
        return __('crud.users.itemTitle');
    }

    public static function getPluralModelLabel(): string
    {
        return __('crud.users.collectionTitle');
    }

    public static function getNavigationLabel(): string
    {
        return __('crud.users.collectionTitle');
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make()->schema([
                Grid::make(['default' => 2])->schema([
                    TextInput::make('name')
                        ->required()
                        ->string()
                        ->autofocus(),

                    TextInput::make('email')
                        ->required()
                        ->string()
                        ->unique('users', 'email', ignoreRecord: true)
                        ->email(),

                    TextInput::make('password')
                        ->required(
                            fn(string $context): bool => $context === 'create'
                        )
                        ->dehydrated(fn($state) => filled($state))
                        ->string()
                        ->minLength(6)
                        ->password(),
                    Forms\Components\Select::make('roles')
                        ->relationship('roles', 'name')
                        ->multiple()
                        ->preload()
                        ->searchable()
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
                TextColumn::make('email')->searchable(),
                TextColumn::make('roles.name')->badge(),
                TextColumn::make('warehouses.name')->default('None'),
                TextColumn::make('maintenanceDepartments.name')->default('None'),

            ])
            ->filters([
                SelectFilter::make('role_id')
                    ->relationship('roles', 'name'),
                    SelectFilter::make('warehouse_id')
                    ->relationship('warehouses', 'name'),
                SelectFilter::make('maintenance_department_id')
                    ->relationship('maintenanceDepartments', 'name')
            ], FiltersLayout::AboveContent)
            ->filtersFormColumns(3  )

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
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'view' => Pages\ViewEmployee::route('/{record}'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
