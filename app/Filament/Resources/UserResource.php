<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
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
use Filament\Pages\Page;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                 //https://filamentphp.com/docs/2.x/forms/layout#card
                 Card::make()
                 ->schema([
                     TextInput::make('name')
                        ->required()
                        ->maxLength(50)
                        ->minLength(3),
                    TextInput::make('email')
                        ->email()//type="email"
                        ->required()
                        ->maxLength(70),
                    TextInput::make('password') //only rquierd at registering ie CreateRecord but not whie editing user
                        ->password()//type="password
                        ->required(fn(Page $livewire): bool => $livewire instanceof CreateRecord)
                        ->maxLength(50)
                        ->minLength(6)
                        ->same('passwordConfirmation')
                        ->dehydrated(fn ($state) => filled($state))
                        ->dehydrateStateUsing(fn($state) => Hash::make($state)),//hash the password
                    TextInput::make('passwordConfirmation')
                        ->password()//type="password
                        ->label('password confirmation')
                        ->required(fn(Page $livewire): bool => $livewire instanceof CreateRecord)
                        ->minLength(6)
                        ->dehydrated(false) // we dont want this field during updating
                 ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                  //
                //https://filamentphp.com/docs/2.x/tables/columns/text
                TextColumn::make('id')->sortable()->searchable(), //one can search
                TextColumn::make('name')->sortable()->searchable(), //one can search
                TextColumn::make('email')->sortable()->searchable(), //one can search
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
