<?php
namespace App\Filament\Resources\IndividualResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use App\Models\User;

class UserRelationManager extends RelationManager
{
    protected static string $relationship = 'users'; // Nome da relação no modelo Individual

    protected static ?string $recordTitleAttribute = 'login';

    protected static ?string $label = 'Usuário';
    protected static ?string $title = 'Usuários';

    public function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(3)
                    ->schema([

                        // E-mail em uma linha separada
                        Forms\Components\TextInput::make('email')
                            ->label('E-mail')
                            ->email()
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('login')
                            ->label('Login')
                            ->required()
                            ->columnSpan(1), // Ocupa 1/3 da linha

                        Forms\Components\TextInput::make('password')
                            ->label('Senha')
                            ->password()
                            ->required(fn (?User $record) => $record === null)
                            ->columnSpan(1), // Ocupa 1/3 da linha

                        Forms\Components\Select::make('roles')
                            ->label('Função')
                            ->relationship('roles', 'name')
                            ->multiple()
                            ->searchable()
                            ->columnSpan(1), // Ocupa 1/3 da linha
                    ])
                    ->columnSpanFull(), // Faz o grid ocupar a largura total do formulário

            ]);

    }

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('login')
                    ->label('Login')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('email')
                    ->label('E-mail')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                // Defina filtros, se necessário
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->mutateFormDataUsing(function (array $data): array {
                        $individual = $this->ownerRecord;
                        $data['name'] = $individual?->name ?? 'Sem Nome';
                        return $data;
                }),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
