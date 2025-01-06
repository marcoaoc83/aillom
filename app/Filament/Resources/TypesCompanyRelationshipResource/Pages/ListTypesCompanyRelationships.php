<?php

namespace App\Filament\Resources\TypesCompanyRelationshipResource\Pages;

use App\Filament\Resources\TypesCompanyRelationshipResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTypesCompanyRelationships extends ListRecords
{
    protected static string $resource = TypesCompanyRelationshipResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
