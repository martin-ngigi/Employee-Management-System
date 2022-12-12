<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CityResource\Pages;
use App\Filament\Resources\CityResource\RelationManagers;
use App\Models\City;
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



class CityResource extends Resource
{
    protected static ?string $model = City::class;

    protected static ?string $navigationIcon = 'heroicon-o-office-building';
    protected static ?string $navigationGroup = 'System Management';

    // numbering purpose ie position
    protected static ?int $navigationSort = 2;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //https://filamentphp.com/docs/2.x/forms/layout#card
                Card::make()
                    ->schema([
                        // ...
                        Select::make('state_id',)
                            ->relationship('state', 'name')
                            ->required(),
                        TextInput::make('name')
                            ->required()
                            ->maxlength(100)
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
                TextColumn::make('state.name')->sortable()->searchable(), //one can search
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
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCities::route('/'),
            'create' => Pages\CreateCity::route('/create'),
            'edit' => Pages\EditCity::route('/{record}/edit'),
        ];
    }
}
