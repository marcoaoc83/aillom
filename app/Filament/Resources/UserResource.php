<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers\AuditsRelationManager;
use App\Models\Individual;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Select;
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
            Select::make('individual_id')
                ->label('Pessoa')
                ->searchable()
                ->getSearchResultsUsing(function (string $search): array {
                    return Individual::query()
                        ->where('name', 'like', "%{$search}%") // Busca pelo nome
                        ->orWhereHas('documents', function ($query) use ($search) {
                            $query->where('description', 'like', "%{$search}%"); // Busca no campo de descrição do documento
                        })
                        ->orderBy('name') // Ordena por nome
                        ->limit(50) // Limita a 50 resultados
                        ->get()
                        ->mapWithKeys(fn($individual) => [
                            $individual->id => "{$individual->name}"
                        ])
                        ->toArray();
                })
                ->getOptionLabelUsing(function ($value): ?string {
                    $individual = Individual::find($value);
                    return $individual ? "{$individual->name}" : null;
                })
                ->required()
                ->placeholder('Selecione uma pessoa')
                ->columnSpan(12),
            Forms\Components\TextInput::make('email')
                ->label('Email')
                ->email()
                ->columnSpan(12),

            // Login, Senha e Função na mesma linha
            Forms\Components\Grid::make(3)
                ->schema([
                    Forms\Components\TextInput::make('login')
                        ->label('Login')
                        ->required()
                        ->columnSpan(1), // Ocupa 1/3 da linha

                    Forms\Components\TextInput::make('password')
                        ->label('Senha')
                        ->password()
                        ->dehydrated(fn ($state) => filled($state))
                        ->required(fn (?User $record) => $record === null)
                        ->maxLength(255)
                        ->columnSpan(1), // Ocupa 1/3 da linha

                    Forms\Components\Select::make('roles')
                        ->label('Função')
                        ->relationship('roles', 'name')
                        ->multiple()
                        ->searchable()
                        ->columnSpan(1), // Ocupa 1/3 da linha
                ])
                ->columnSpan(12), // Define o grid em toda a largura
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
