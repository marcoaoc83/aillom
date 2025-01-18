<?php

namespace App\Filament\Resources;

use App\Filament\Exports\IndividualExporter;
use App\Filament\Resources\IndividualResource\Pages;
use App\Filament\Resources\IndividualResource\RelationManagers;
use App\Models\Address;
use App\Models\Individual;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class IndividualResource extends BaseResource
{

    protected static ?string $label = 'Pessoa';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationGroup = 'Cadastros';
    protected static ?string $model = \App\Models\Individual::class;

    protected static ?string $navigationIcon = 'heroicon-m-identification';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            \Filament\Forms\Components\Tabs::make('Detalhes')
                ->tabs([
                    \Filament\Forms\Components\Tabs\Tab::make('Informações')
                        ->schema([
                            \Filament\Forms\Components\TextInput::make('name')
                                ->label('Nome')
                                ->required()
                                ->maxLength(230)
                                ->columnSpan(6),

                            \Filament\Forms\Components\TextInput::make('social_name')
                                ->label('Nome Social')
                                ->maxLength(230)
                                ->columnSpan(6),

                            \Filament\Forms\Components\TextInput::make('nationality')
                                ->label('Nacionalidade')
                                ->maxLength(100)
                                ->columnSpan(6),

                            \Filament\Forms\Components\Select::make('birth_place_id')
                                ->label('Naturalidade')
                                ->searchable()
                                ->getSearchResultsUsing(function (string $search): array {
                                    return Address::query()
                                        ->where(function ($query) use ($search) {
                                            $query->where('description', 'like', "%{$search}%");

                                            if (preg_match('/^\d+$/', $search)) {
                                                $query->orWhere('postal_code', 'like', "%{$search}%");
                                            }
                                        })
                                        ->orderBy('hierarchical_code') // Ordena pelo campo hierarchy_code
                                        ->limit(50) // Limita os resultados a 50 registros
                                        ->get()
                                        ->mapWithKeys(fn($address) => [$address->id => $address->full_path]) // Usa o atributo full_path como rótulo
                                        ->toArray();
                                })
                                ->getOptionLabelUsing(function ($value): ?string {
                                    return Address::find($value)?->full_path; // Retorna o texto da opção selecionada com full_path
                                })
                                ->placeholder('Selecione um endereço')
                                ->columnSpan(6),


                            \Filament\Forms\Components\DatePicker::make('birth_date')
                                ->label('Nascimento')
                                ->columnSpan(6),

                            \Filament\Forms\Components\DatePicker::make('death_date')
                                ->label('Falecimento')
                                ->columnSpan(6),

                            \Filament\Forms\Components\Select::make('gender_id')
                                ->label('Gênero')
                                ->relationship('gender', 'description')
                                ->searchable()
                                ->columnSpan(6),
                            \Filament\Forms\Components\Radio::make('sex')
                                ->label('Sexo')
                                ->options([
                                    'M' => 'Masculino',
                                    'F' => 'Feminino',
                                ])
                                ->required()
                                ->columnSpan(6),
                        ])
                        ->columns(12),
                ])->columnSpan(12),
        ]);
    }


    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('name')->label('Nome'),
            ])
            ->filters([
                Tables\Filters\Filter::make('name')
                    ->label('Nome')
                    ->form([
                        \Filament\Forms\Components\TextInput::make('name')
                            ->label('Nome'),
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $query->when(
                            $data['name'] ?? null,
                            fn($query, $name) => $query->where('name', 'like', "%{$name}%")
                        );
                    }),

                Tables\Filters\Filter::make('documents')
                    ->label('Documentos')
                    ->form([
                        \Filament\Forms\Components\TextInput::make('document_number')
                            ->label('Número do Documento'),
                    ])
                    ->query(function (Builder $query, array $data) {
                        // Verifica se há valor no campo 'document_number'
                        return $query->when(
                            $data['document_number'] ?? null,
                            function (Builder $query, $documentNumber) {
                                // Remove caracteres indesejados antes de aplicar o filtro
                                $cleanedNumber = preg_replace('/\D/', '', $documentNumber);

                                $query->whereHas('documents', function (Builder $subQuery) use ($cleanedNumber) {
                                    $subQuery->where('document_number', 'LIKE', "%{$cleanedNumber}%");
                                });
                            }
                        );
                    })
            ]);
    }


    public static function getRelations(): array
    {
        return [
            RelationManagers\IndividualAddressRelationManager::class,
            RelationManagers\IndividualContactRelationManager::class,
            RelationManagers\IndividualDocumentRelationManager::class,
            RelationManagers\IndividualRelationshipRelationManager::class,
            RelationManagers\IndividualFileRelationManager::class,
            RelationManagers\UserRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListIndividuals::route('/'),
            'create' => Pages\CreateIndividual::route('/create'),
            'edit' => Pages\EditIndividual::route('/{record}/edit'),
        ];
    }
}
