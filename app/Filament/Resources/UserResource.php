<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers\AuditsRelationManager;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Traits\HasTabbedFormAndRelations;
class UserResource extends BaseResource
{
    use HasTabbedFormAndRelations;

    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'Acesso';
    protected static ?string $navigationLabel = 'Usuários';


    public static function getNavigationBadge(): ?string
    {
        return (string) User::count();
    }

    protected static function getGeneralSchema(): array
    {
        return [
            Forms\Components\TextInput::make('name')
                ->label('Nome Completo')
                ->required(),
            Forms\Components\TextInput::make('email')
                ->label('Email')
                ->email()
                ->required(),
            Forms\Components\Grid::make(2) // Cria uma grade com 2 colunas
            ->schema([
                Forms\Components\TextInput::make('password')
                    ->label('Senha')
                    ->password()
                    ->dehydrated(fn ($state) => filled($state)) // Apenas salva se o estado estiver preenchido
                    ->required(fn (?User $record) => $record === null) // Obrigatório apenas no cadastro
                    ->maxLength(255),
                Forms\Components\Select::make('roles')
                    ->label('Função')
                    ->relationship('roles', 'name')
                    ->multiple()
                    ->searchable(),
            ]),
        ];
    }



    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Nome'),
                Tables\Columns\TextColumn::make('email')->label('Email'),
                Tables\Columns\TextColumn::make('roles.name')
                    ->label('Função')
                    ->separator(', '),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([]);
    }

    public static function getRelations(): array
    {
        return [

        ];
    }
    public static function getModelLabel(): string
    {
        return 'Usuário'; // Nome singular
    }

    public static function getPluralModelLabel(): string
    {
        return 'Usuários'; // Nome plural
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
