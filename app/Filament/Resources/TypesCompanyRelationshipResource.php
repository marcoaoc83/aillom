<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TypesCompanyRelationshipResource\Pages;
use App\Filament\Resources\TypesCompanyRelationshipResource\RelationManagers;
use App\Models\TypesCompanyRelationship;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TypesCompanyRelationshipResource extends BaseResource
{

    protected static ?string $label = 'Tipos Vínculo';

    protected static ?int $navigationSort = 99;

    protected static ?string $navigationGroup = 'Geral';
    protected static ?string $model = \App\Models\TypesCompanyRelationship::class;

    protected static ?string $navigationIcon = 'heroicon-c-briefcase';

    public static function form(Forms\Form $form): Forms\Form {
        return $form->schema([
            \Filament\Forms\Components\Tabs::make('Detalhes')
    ->tabs([
        \Filament\Forms\Components\Tabs\Tab::make('Informações')
            ->schema([
\Filament\Forms\Components\TextInput::make('description')->label('Descrição')->required()->maxLength(200)
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
            'index' => Pages\ListTypesCompanyRelationships::route('/'),
            'create' => Pages\CreateTypesCompanyRelationship::route('/create'),
            'edit' => Pages\EditTypesCompanyRelationship::route('/{record}/edit'),
        ];
    }
}
