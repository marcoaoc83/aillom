<?php

namespace App\Filament\Resources\CompanyResource\RelationManagers;

use App\Filament\Actions\Individual\CriarRelacionamentoInverso;
use App\Models\Individual;
use App\Models\IndividualRelationship;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Forms;
use Filament\Tables;

class CompanyRelationshipRelationManager extends RelationManager
{
    protected static string $relationship = 'relationships';

    protected static ?string $label = 'Relacionamento';
    protected static ?string $title = 'Relacionamentos';

    public function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Forms\Components\Select::make('individual_id')
                ->label('Pessoa')
                ->relationship('individual', 'name')
                ->searchable()
                ->getSearchResultsUsing(function (string $search): array {
                    return Individual::query()
                        ->where('name', 'like', "%{$search}%") // Busca pelo nome
                        ->orWhereHas('documents', function ($query) use ($search) {
                            $query->where('document_number', 'like', "%{$search}%"); // Busca no campo de descrição do documento
                        })
                        ->orderBy('name') // Ordena por nome
                        ->limit(50)
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
                ->placeholder('Selecione a pessoa'),

            Forms\Components\Select::make('relationship_type_id')
                ->label('Tipo de Relacionamento')
                ->relationship('relationshipType', 'description')
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
                Tables\Columns\TextColumn::make('individual.name')
                    ->label('Indivíduo Relacionado')
                    ->sortable(),

                Tables\Columns\TextColumn::make('relationshipType.description')
                    ->label('Tipo de Relacionamento')
                    ->sortable(),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }
}
