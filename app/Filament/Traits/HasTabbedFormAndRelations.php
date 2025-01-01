<?php

namespace App\Filament\Traits;

use Filament\Forms\Components\Tabs;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Form;

trait HasTabbedFormAndRelations
{
    public static function form(Form $form): Form
    {
        $tabs = [
            Tabs\Tab::make('Principal')
                ->schema(static::getGeneralSchema()),
        ];

        // Adiciona uma aba para cada relacionamento definido em getRelations
        foreach (static::getRelations() as $relationManagerClass) {
            $relationshipName = $relationManagerClass::getRelationshipName();

            $tabs[] = Tabs\Tab::make(ucfirst($relationshipName))
                ->schema([
                    \Filament\Forms\Components\Placeholder::make("relationship_{$relationshipName}")
                        ->label($relationshipName)
                        ->content(fn (?Model $record) => view('filament.relation-tab', [
                            'relationManagerClass' => $relationManagerClass,
                            'record' => $record,
                        ])),
                ])
                ->columns(1); // Cada aba ocupará 100% da largura
        }

        return $form->schema([
            Tabs::make('Formulário')
                ->tabs($tabs)
                ->columnSpan('full') // Garante que as abas ocupem toda a largura
                ->columns(1),        // Define a largura como 1 coluna, ou seja, 100%
        ]);
    }

    protected static function getGeneralSchema(): array
    {
        return [
            // Define os campos padrão aqui
        ];
    }
}
