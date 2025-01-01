<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AddressesResource\Pages;
use App\Filament\Resources\AddressesResource\RelationManagers;
use App\Models\Address;
use App\Models\Addresses;
use CodeWithDennis\FilamentSelectTree\SelectTree;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Log;

class AddressesResource extends BaseResource
{

    protected static ?string $navigationGroup = 'Geral';
    protected static ?string $label = 'Endereços';
    protected static ?string $model = \App\Models\Address::class;

    protected static ?string $navigationIcon = 'heroicon-c-globe-americas';

    public static function form(Forms\Form $form): Forms\Form {
        return $form->schema([
            \Filament\Forms\Components\Tabs::make('Detalhes')
    ->tabs([
        \Filament\Forms\Components\Tabs\Tab::make('Informações')
            ->schema([
                Select::make('parent_id')
                    ->label('Endereço Pai')
                    ->searchable() // Habilita busca
                    ->getSearchResultsUsing(function (string $search): array {
                        return Address::query()
                            ->where(function ($query) use ($search) {
                                $query->where('description', 'like', "%{$search}%")
                                    ->orWhere('postal_code', 'like', "%{$search}%"); // Busca também no postal_code
                            })
                            ->orderBy('hierarchy_code') // Ordena pelo campo hierarchy_code
                            ->limit(50) // Limita os resultados a 50 registros
                            ->get() // Obtém os registros
                            ->mapWithKeys(fn($address) => [$address->id => $address->full_path]) // Usa o atributo full_path como rótulo
                            ->toArray();
                    })
                    ->getOptionLabelUsing(function ($value): ?string {
                        return Address::find($value)?->full_path; // Retorna o texto da opção selecionada com full_path
                    })
                    ->placeholder('Selecione um endereço pai'), // Texto padrão
                \Filament\Forms\Components\TextInput::make('description')->label('Desrição')->required(),
                \Filament\Forms\Components\TextInput::make('abbreviation')->label('Abreviatura'),
                \Filament\Forms\Components\TextInput::make('postal_code')->label('CEP'),
                \Filament\Forms\Components\TextInput::make('ddd')->label('DDD'),
                \Filament\Forms\Components\TextInput::make('ddi')->label('DDI')
            ]),
    ])->columnSpan(12)
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('description')->label('Nome'),
                Tables\Columns\TextColumn::make('postal_code')->label('Abreviatura'),
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
            'index' => Pages\ListAddresses::route('/'),
            'create' => Pages\CreateAddresses::route('/create'),
            'edit' => Pages\EditAddresses::route('/{record}/edit'),
        ];
    }
}
