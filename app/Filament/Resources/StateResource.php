<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CountryResource\RelationManagers\EmployeesRelationManager;
use App\Filament\Resources\StateResource\Pages;
use App\Filament\Resources\StateResource\RelationManagers;
use App\Filament\Resources\StateResource\RelationManagers\CitiesRelationManager;
use App\Models\State;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Card;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;


class StateResource extends Resource
{
    protected static ?string $model = State::class;

    protected static ?string $navigationIcon = 'heroicon-o-office-building';
    protected static ?string $navigationGroup = 'System Management';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //https://filamentphp.com/docs/2.x/forms/layout#card
                Card::make()
                    ->schema([
                        // ...
                        Select::make('country_id',)
                            ->relationship('country', 'name')->required(),
                        TextInput::make('name')->required()->maxLength(100)
                    ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                //https://filamentphp.com/docs/2.x/tables/columns/text
                TextColumn::make('id')->sortable()->searchable(), //one can search
                TextColumn::make('name')->sortable()->searchable(), //one can search
                TextColumn::make('country.name')->sortable()->searchable(), //one can search
                TextColumn::make('created_at')->dateTime()

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
            EmployeesRelationManager::class,
            CitiesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStates::route('/'),
            'create' => Pages\CreateState::route('/create'),
            'edit' => Pages\EditState::route('/{record}/edit'),
        ];
    }
}
