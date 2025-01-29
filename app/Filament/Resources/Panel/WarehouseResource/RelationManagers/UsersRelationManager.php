<?php

namespace App\Filament\Resources\Panel\WarehouseResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\Grid;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\Panel\WarehouseResource;
use Filament\Resources\RelationManagers\RelationManager;

class UsersRelationManager extends RelationManager
{
    protected static string $relationship = 'users';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $label = 'Employee';

    /**
     * @deprecated Override the `table()` method to configure the table.
     */
    protected static ?string $pluralLabel = 'Employees';

    /**
     * @deprecated Override the `table()` method to configure the table.
     */
    protected static ?string $modelLabel = 'Employee';

    /**
     * @deprecated Override the `table()` method to configure the table.
     */
    protected static ?string $pluralModelLabel = 'Employees';

    protected static ?string $title = 'Employees';

    public function form(Form $form): Form
    {
        return $form->schema([Grid::make(['default' => 1])->schema([])]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([])
            ->filters([])
            ->headerActions([
                Tables\Actions\AttachAction::make()->form(
                    fn(Tables\Actions\AttachAction $action): array => [
                        $action->getRecordSelect(),
                    ]
                ),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\DetachAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),

                    Tables\Actions\DetachBulkAction::make(),
                ]),
            ]);
    }
}
