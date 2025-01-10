<?php

namespace App\Filament\Resources\IndividualResource\RelationManagers;

use App\Filament\Actions\Individual\CriarRelacionamentoInverso;
use App\Models\IndividualRelationship;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Forms;
use Filament\Tables;

class IndividualRelationshipRelationManager extends RelationManager
{
    protected static string $relationship = 'relationships';

    protected static ?string $label = 'Relacionamento';
    protected static ?string $title = 'Relacionamentos';

    public function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Forms\Components\Select::make('individual_id2')
                ->label('Pessoa')
                ->relationship('relatedIndividual', 'name')
                ->searchable()
                ->required()
                ->placeholder('Selecione a pessoa'),

            Forms\Components\Select::make('relationship_type_id')
                ->label('Tipo de Relacionamento')
                ->relationship('relationshipType', 'description')
                ->searchable()
                ->required()
                ->placeholder('Selecione o tipo de relacionamento'),

            Forms\Components\DatePicker::make('relationship_start_date')
                ->label('Data de Início do Relacionamento'),
        ]);
    }

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('relatedIndividual.name')
                    ->label('Indivíduo Relacionado')
                    ->sortable(),

                Tables\Columns\TextColumn::make('relationshipType.description')
                    ->label('Tipo de Relacionamento')
                    ->sortable(),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->after(function (IndividualRelationship $record) {
                        CriarRelacionamentoInverso::handle($record);
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }
}
