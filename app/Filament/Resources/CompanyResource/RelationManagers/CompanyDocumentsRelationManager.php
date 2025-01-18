<?php

namespace App\Filament\Resources\CompanyResource\RelationManagers;

use App\Models\Address;
use App\Models\TypesDocument;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Forms;
use Filament\Tables;

class CompanyDocumentsRelationManager extends RelationManager
{
    protected static string $relationship = 'documents';
    protected static ?string $label = 'Documento';
    protected static ?string $title = 'Documentos';

    public function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Forms\Components\Select::make('document_type_id')
                ->label('Tipo de Documento')
                ->relationship('documentType', 'description', fn ($query) => $query->forPJ())
                ->required()
                ->placeholder('Selecione o tipo de documento')
                ->reactive()
                ->afterStateUpdated(function ($state, callable $set) {
                    if ($state) {
                        $mask = TypesDocument::find($state)?->mask;
                        $set('number_mask', $mask);
                    }
                }),

            Forms\Components\TextInput::make('document_number')
                ->label('Número')
                ->required()
                ->maxLength(255)
                ->mask(fn (callable $get) => $get('number_mask'))
                ->helperText(function (callable $get) {
                    $mask = $get('number_mask');
                    return $mask ? "Formato esperado: {$mask}" : null;
                }),

            Forms\Components\TextInput::make('description')
                ->label('Descrição')
                ->maxLength(255),
        ]);
    }


    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('documentType.description')
                    ->label('Tipo de Documento')
                    ->sortable(),

                Tables\Columns\TextColumn::make('document_number')
                    ->label('Número')
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
