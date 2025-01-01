<?php

namespace App\Filament\Resources\TypesDocumentResource\Pages;

use App\Filament\Resources\TypesDocumentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTypesDocuments extends ListRecords
{
    protected static string $resource = TypesDocumentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
