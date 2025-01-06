<?php

namespace App\Filament\Resources\TypesIndividualRelationshipResource\Pages;

use App\Filament\Resources\TypesIndividualRelationshipResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTypesIndividualRelationships extends ListRecords
{
    protected static string $resource = TypesIndividualRelationshipResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
