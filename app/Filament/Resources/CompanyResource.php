<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompanyResource\Pages;
use App\Filament\Resources\CompanyResource\RelationManagers;
use App\Models\Company;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CompanyResource extends BaseResource
{

    protected static ?string $label = 'Empresas';

    protected static ?int $navigationSort = 30;

    protected static ?string $navigationGroup = 'Cadastros';
    protected static ?string $model = \App\Models\Company::class;

    protected static ?string $navigationIcon = 'heroicon-c-building-office';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            \Filament\Forms\Components\Tabs::make('Detalhes')
                ->tabs([
                    \Filament\Forms\Components\Tabs\Tab::make('Informações')
                        ->schema([
                            \Filament\Forms\Components\TextInput::make('company_name')->label('Nome')->required()->maxLength(250),
                            \Filament\Forms\Components\TextInput::make('trade_name')->label('Fantasia')->maxLength(250),
                            \Filament\Forms\Components\DatePicker::make('opening_date')->label('Data Abertura'),
                            \Filament\Forms\Components\Select::make('level_id')
                                ->label('Classificação')
                                ->relationship('level', 'description') // Relacionamento com a tabela types_address
                                ->columnSpan('full'),
                            \Filament\Forms\Components\Select::make('type_company_id')
                                ->label('Natureza Jurídica')
                                ->relationship('typeCompany', 'description') // Relacionamento com a tabela types_address
                                ->columnSpan('full'),
                        ]),
                ])->columnSpan(12),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            \Filament\Tables\Columns\TextColumn::make('company_name')->label('Nome')
        ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\CompanyAddressRelationManager::class,
            RelationManagers\CompanyDocumentsRelationManager::class,
            RelationManagers\CompanyFileRelationManager::class,
            RelationManagers\CompanyRelationshipRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCompanies::route('/'),
            'create' => Pages\CreateCompany::route('/create'),
            'edit' => Pages\EditCompany::route('/{record}/edit'),
        ];
    }
}
