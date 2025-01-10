<?php

namespace App\Filament\Resources\IndividualResource\RelationManagers;

use App\Models\Address;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Forms;
use Filament\Tables;

class IndividualAddressRelationManager extends RelationManager
{
    protected static string $relationship = 'addresses';
    protected static ?string $label = 'Endereço';
    protected static ?string $title = 'Endereços';

    public function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            // Primeira Linha: Endereço
            Forms\Components\Select::make('address_id')
                ->label('Endereço')
                ->searchable()
                ->getSearchResultsUsing(function (string $search): array {
                    return Address::query()
                        ->where(function ($query) use ($search) {
                            $query->where('description', 'like', "%{$search}%")
                                ->orWhere('postal_code', 'like', "%{$search}%");
                        })
                        ->orderBy('hierarchical_code')
                        ->limit(50)
                        ->get()
                        ->mapWithKeys(fn($address) => [$address->id => $address->full_path])
                        ->toArray();
                })
                ->getOptionLabelUsing(function ($value): ?string {
                    return Address::find($value)?->full_path;
                })
                ->placeholder('Selecione um endereço')
                ->required()
                ->columnSpan('full'), // Ocupa toda a largura
            Forms\Components\Select::make('address_type_id')
                ->label('Tipo de Endereço')
                ->relationship('type', 'description') // Relacionamento com a tabela types_address
                ->searchable()
                ->placeholder('Selecione o tipo de endereço')
                ->columnSpan('full'),
            Forms\Components\TextInput::make('number_address')
                ->label('Número')
                ->maxLength(20)
                ->required()
                ->columnSpan(1), // Ocupa metade da linha

            Forms\Components\TextInput::make('complement')
                ->label('Complemento')
                ->maxLength(255)
                ->columnSpan(3), // Ocupa o restante da linha
        ])->columns(4); // Define 4 colunas para a estrutura
    }


    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('address.description')
                    ->label('Endereço')
                    ->sortable(),
                Tables\Columns\TextColumn::make('type.description')
                    ->label('Tipo de Endereço'),
                Tables\Columns\TextColumn::make('number_address')
                    ->label('Número'),
                Tables\Columns\TextColumn::make('address.postal_code')
                    ->label('CEP'),
            ])
            ->filters([]) // Adicione filtros se necessário
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }
}
