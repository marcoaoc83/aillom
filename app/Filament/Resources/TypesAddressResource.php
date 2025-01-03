<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TypesAddressResource\Pages;
use App\Filament\Resources\TypesAddressResource\RelationManagers;
use App\Models\TypesAddress;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TypesAddressResource extends BaseResource
{

    protected static ?string $navigationGroup = 'Geral';
    protected static ?string $model = \App\Models\TypesAddress::class;
    protected static ?string $label = 'Tipos Endereços';
    protected static ?string $navigationIcon = 'fas-map-location-dot';
    protected static ?int $navigationSort = 59;
    public static function form(Forms\Form $form): Forms\Form {
        return $form->schema([
            \Filament\Forms\Components\Tabs::make('Detalhes')
    ->tabs([
        \Filament\Forms\Components\Tabs\Tab::make('Informações')
            ->schema([
\Filament\Forms\Components\TextInput::make('description')->label('Descrição')->required()
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
            'index' => Pages\ListTypesAddresses::route('/'),
            'create' => Pages\CreateTypesAddress::route('/create'),
            'edit' => Pages\EditTypesAddress::route('/{record}/edit'),
        ];
    }
}
