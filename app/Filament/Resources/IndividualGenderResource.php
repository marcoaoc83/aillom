<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IndividualGenderResource\Pages;
use App\Filament\Resources\IndividualGenderResource\RelationManagers;
use App\Models\IndividualGender;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class IndividualGenderResource extends BaseResource
{

    protected static ?string $label = 'Gêneros';
    protected static ?int $navigationSort = 35;
    protected static ?string $navigationGroup = 'Geral';
    protected static ?string $model = \App\Models\IndividualGender::class;
    protected static ?string $navigationIcon = 'fas-transgender';

    public static function form(Forms\Form $form): Forms\Form
    {
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

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            \Filament\Tables\Columns\TextColumn::make('description')->label('Descrição')
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
            'index' => Pages\ListIndividualGenders::route('/'),
            'create' => Pages\CreateIndividualGender::route('/create'),
            'edit' => Pages\EditIndividualGender::route('/{record}/edit'),
        ];
    }
}
