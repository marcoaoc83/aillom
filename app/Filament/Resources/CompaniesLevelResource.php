<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompaniesLevelResource\Pages;
use App\Filament\Resources\CompaniesLevelResource\RelationManagers;
use App\Models\CompaniesLevel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CompaniesLevelResource extends BaseResource
{

    protected static ?string $label = 'Categoria Empresa';

    protected static ?int $navigationSort = 29;

    protected static ?string $navigationGroup = 'Geral';
    protected static ?string $model = \App\Models\CompaniesLevel::class;

    protected static ?string $navigationIcon = 'heroicon-c-building-storefront';

    public static function form(Forms\Form $form): Forms\Form {
        return $form->schema([
            \Filament\Forms\Components\Tabs::make('Detalhes')
    ->tabs([
        \Filament\Forms\Components\Tabs\Tab::make('Informações')
            ->schema([
\Filament\Forms\Components\TextInput::make('description')->label('Descrição')->required()->maxLength(250)
            ]),
    ])
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table {
        return $table->columns([
            \Filament\Tables\Columns\TextColumn::make('description')->label('Descrição')->sortable()->searchable()
        ]);
    }

    public static function getRelations(): array {
        return [

        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCompaniesLevels::route('/'),
            'create' => Pages\CreateCompaniesLevel::route('/create'),
            'edit' => Pages\EditCompaniesLevel::route('/{record}/edit'),
        ];
    }
}
