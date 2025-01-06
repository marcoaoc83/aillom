<?php

namespace App\Filament\Resources;

use App\Enums\EntityType;
use App\Filament\Resources\TypesDocumentResource\Pages;
use App\Filament\Resources\TypesDocumentResource\RelationManagers;
use App\Models\TypesDocument;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TypesDocumentResource extends BaseResource
{

    protected static ?string $navigationGroup = 'Geral';
    protected static ?string $model = \App\Models\TypesDocument::class;

    protected static ?string $navigationIcon = 'fas-passport';
    protected static ?string $label = 'Tipos Documento';
    protected static ?int $navigationSort = 49;

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            \Filament\Forms\Components\Tabs::make('Detalhes')
                ->tabs([
                    \Filament\Forms\Components\Tabs\Tab::make('Informações')
                        ->schema([
                            \Filament\Forms\Components\TextInput::make('description')->label('Descrição')->required()->maxLength(200),
                            \Filament\Forms\Components\Select::make('entity_type')
                                ->label('Tipo')
                                ->options(EntityType::toArray())
                                ->required()
                                ->native(false),
                            \Filament\Forms\Components\TextInput::make('regex')->label('Mascara')
                        ]),
                ])
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            \Filament\Tables\Columns\TextColumn::make('description')->label('Descrição')->sortable()->searchable(),
            \Filament\Tables\Columns\TextColumn::make('entity_type')->label('Tipo')->sortable()->searchable(),
        ]);
    }

    public static function getRelations(): array
    {
        return [

        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTypesDocuments::route('/'),
            'create' => Pages\CreateTypesDocument::route('/create'),
            'edit' => Pages\EditTypesDocument::route('/{record}/edit'),
        ];
    }
}
