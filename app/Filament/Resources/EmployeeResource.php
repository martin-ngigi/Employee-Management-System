<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmployeeResource\Pages;
use App\Filament\Resources\EmployeeResource\RelationManagers;
use App\Models\Employee;
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
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\SelectFilter;




class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //https://filamentphp.com/docs/2.x/forms/layout#card
                Card::make()
                ->schema([
                     // ...
                    Select::make('country_id',)
                         ->relationship('country', 'name') -> required(),
                    Select::make('state_id',)
                         ->relationship('state', 'name') -> required(),
                    Select::make('city_id',)
                         ->relationship('city', 'name') -> required(),
                    Select::make('department_id',)
                         ->relationship('department', 'name') -> required(),
                    TextInput::make('first_name') -> required(),
                    TextInput::make('last_name') -> required(),
                    TextInput::make('address') -> required(),
                    TextInput::make('zip_code') -> required(),
                    DatePicker::make('birth_date') -> required(),
                    DatePicker::make('date_hired') -> required(),
                 ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //https://filamentphp.com/docs/2.x/tables/columns/text
                TextColumn::make('id')->sortable()->searchable(), //one can search
                TextColumn::make('first_name')->sortable()->searchable(), //one can search
                TextColumn::make('last_name')->sortable()->searchable(), //one can search
                TextColumn::make('department.name')->sortable()->searchable(), //one can search
                TextColumn::make('date_hired')->dateTime(),
                TextColumn::make('created_at')->dateTime(),

            ])
            ->filters([
                //https://filamentphp.com/docs/2.x/tables/filters#getting-started
                SelectFilter::make('department')->relationship('department', 'name')
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
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}
