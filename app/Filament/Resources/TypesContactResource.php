<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TypesContactResource\Pages;
use App\Filament\Resources\TypesContactResource\RelationManagers;
use App\Models\TypesContact;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TypesContactResource extends BaseResource
{

    protected static ?string $navigationGroup = 'Geral';
    protected static ?string $model = \App\Models\TypesContact::class;

    protected static ?string $navigationIcon = 'fas-mail-bulk';
    protected static ?string $label = 'Tipos Contatos';

    public static function form(Forms\Form $form): Forms\Form {
        return $form->schema([
            \Filament\Forms\Components\Tabs::make('Detalhes')->tabs([
                \Filament\Forms\Components\Tabs\Tab::make('Informações')->schema([
                    \Filament\Forms\Components\TextInput::make('description')->label('Descrição')->required(),
                    \Filament\Forms\Components\TextInput::make('regex')->label('Mascara')
                ]),
            ])
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('description')->label('Descrição'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array {
        return [

        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTypesContacts::route('/'),
            'create' => Pages\CreateTypesContact::route('/create'),
            'edit' => Pages\EditTypesContact::route('/{record}/edit'),
        ];
    }
}
