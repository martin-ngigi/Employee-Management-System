<?php

namespace App\Filament\Resources\DepartmentResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\City;
use App\Models\Country;
use App\Models\Employee;
use App\Models\State;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Card;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\SelectFilter;

class EmployeesRelationManager extends RelationManager
{
    protected static string $relationship = 'employees';

    protected static ?string $recordTitleAttribute = 'first_name';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            // When one selects a country, display only the states present in that country.
            Select::make('country_id')
                ->label('Country')
                ->options(Country::all()->pluck('name', 'id')->toArray())
                ->reactive()
                ->required()
                ->afterStateUpdated(fn(callable $set) => $set('state_id', null)),

            // When one selects a state, display only the cities present in that country.
            Select::make('state_id')
                ->label('State')
                ->options(function (callable $get) {
                    $country = Country::find($get('country_id'));
                    if (!$country) {
                        //if there is no country
                        return State::all()->pluck('name', 'id');
                    }
                    return $country->states->pluck('name', 'id');
                })
                ->required()
                ->reactive()
                ->afterStateUpdated(fn(callable $set) => $set('city_id', null)),

            // When one selects a city, display only the departments present in that country.
            Select::make('city_id')
                ->label('City')
                ->options(function (callable $get) {
                    $state = State::find($get('state_id'));
                    if (!$state) {
                        //if there is no state
                        return City::all()->pluck('name', 'id');
                    }
                    return $state->cities->pluck('name', 'id');
                })
                ->required()
                ->reactive(),

            TextInput::make('first_name')->required()->maxLength(100),
            TextInput::make('last_name')->required()->maxLength(100),
            TextInput::make('address')->required()->maxLength(100),
            TextInput::make('zip_code')->required()->maxLength(100),
            DatePicker::make('birth_date')->required(),
            DatePicker::make('date_hired')->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable()->searchable(), //one can search
                TextColumn::make('first_name')->sortable()->searchable(), //one can search
                TextColumn::make('last_name')->sortable()->searchable(), //one can search
                TextColumn::make('department.name')->sortable()->searchable(), //one can search
                TextColumn::make('date_hired')->dateTime(),
                TextColumn::make('created_at')->dateTime(),

            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
