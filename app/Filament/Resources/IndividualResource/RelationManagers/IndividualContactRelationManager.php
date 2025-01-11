<?php

namespace App\Filament\Resources\IndividualResource\RelationManagers;

use App\Models\TypesContact;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Forms;
use Filament\Tables;


class IndividualContactRelationManager extends RelationManager
{
    protected static string $relationship = 'contacts'; // Nome do relacionamento no Model

    protected static ?string $recordTitleAttribute = 'description';
    protected static ?string $label = 'Contato';
    protected static ?string $title = 'Contatos';
    public function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('contact_type')
                    ->label('Tipo de Contato')
                    ->relationship('contactType', 'description', fn ($query) => $query) // Ajuste o escopo do query se necessário
                    ->required()
                    ->placeholder('Selecione o tipo de contato')
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        if ($state) {
                            $mask = TypesContact::find($state)?->mask; // Obtém a máscara do tipo de contato
                            $set('contact_mask', $mask); // Atualiza a máscara no formulário
                        }
                    }),


                Forms\Components\TextInput::make('description')
                    ->label('Descrição')
                    ->required()
                    ->maxLength(255)
                    ->mask(fn (callable $get) => $get('contact_mask'))
                    ->helperText(function (callable $get) {
                        $mask = $get('contact_mask');
                        return $mask ? "Formato esperado: {$mask}" : null;
                    }),
            ]);
    }

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('contactType.description') // Relacionamento com a descrição
                ->label('Tipo de Contato')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('description')
                    ->label('Descrição')
                    ->sortable()
                    ->searchable(),
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
