<?php

namespace App\Filament\Resources\IndividualResource\RelationManagers;

use App\Models\DocumentType;
use App\Models\TypesDocument;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Forms;
use Filament\Tables;

class IndividualDocumentRelationManager extends RelationManager
{
    protected static string $relationship = 'documents';
    protected static ?string $label = 'Documento';
    protected static ?string $title = 'Documentos';

    public function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Forms\Components\Select::make('document_type_id')
                ->label('Tipo de Documento')
                ->relationship('documentType', 'description', fn ($query) => $query->forPf())
                ->required()
                ->placeholder('Selecione o tipo de documento')
                ->reactive()
                ->afterStateUpdated(function ($state, callable $set) {
                    if ($state) {
                        $mask = TypesDocument::find($state)?->mask;
                        $set('description_mask', $mask);
                    }
                }),

            Forms\Components\TextInput::make('description')
                ->label('Descrição')
                ->required()
                ->maxLength(255)
                ->mask(fn (callable $get) => $get('description_mask'))
                ->helperText(function (callable $get) {
                    $mask = $get('description_mask');
                    return $mask ? "Formato esperado: {$mask}" : null;
                }),
        ]);
    }


    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('documentType.description')
                    ->label('Tipo de Documento')
                    ->sortable(),

                Tables\Columns\TextColumn::make('description')
                    ->label('Descrição')
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
