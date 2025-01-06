<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TypesIndividualRelationshipResource\Pages;
use App\Filament\Resources\TypesIndividualRelationshipResource\RelationManagers;
use App\Models\TypesIndividualRelationship;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TypesIndividualRelationshipResource extends BaseResource
{

    protected static ?string $label = 'Tipos Relacionamento';

    protected static ?int $navigationSort = 79;

    protected static ?string $navigationGroup = 'Geral';
    protected static ?string $model = \App\Models\TypesIndividualRelationship::class;

    protected static ?string $navigationIcon = 'fas-users-rays';

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
            'index' => Pages\ListTypesIndividualRelationships::route('/'),
            'create' => Pages\CreateTypesIndividualRelationship::route('/create'),
            'edit' => Pages\EditTypesIndividualRelationship::route('/{record}/edit'),
        ];
    }
}
