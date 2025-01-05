<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TypesCompanyResource\Pages;
use App\Filament\Resources\TypesCompanyResource\RelationManagers;
use App\Models\TypesCompany;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TypesCompanyResource extends BaseResource
{

    protected static ?string $navigationGroup = 'Geral';
    protected static ?string $model = \App\Models\TypesCompany::class;
    protected static ?string $label = 'Tipos Empresas';
    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';
    protected static ?int $navigationSort = 89;

    public static function form(Forms\Form $form): Forms\Form {
        return $form->schema([
            \Filament\Forms\Components\Tabs::make('Detalhes')
    ->tabs([
        \Filament\Forms\Components\Tabs\Tab::make('Informações')
            ->schema([
\Filament\Forms\Components\TextInput::make('code')->label('Código')->required()->maxLength(10),
                \Filament\Forms\Components\TextInput::make('description')->label('Descrição')->required()
            ]),
    ])
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table {
        return $table->columns([
            \Filament\Tables\Columns\TextColumn::make('code')->label('Código'),
            \Filament\Tables\Columns\TextColumn::make('description')->label('Descrição')
        ]);
    }

    public static function getRelations(): array {
        return [

        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTypesCompanies::route('/'),
            'create' => Pages\CreateTypesCompany::route('/create'),
            'edit' => Pages\EditTypesCompany::route('/{record}/edit'),
        ];
    }
}
