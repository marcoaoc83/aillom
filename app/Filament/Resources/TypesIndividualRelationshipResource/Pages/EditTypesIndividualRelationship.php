<?php

namespace App\Filament\Resources\TypesIndividualRelationshipResource\Pages;

use App\Filament\Resources\TypesIndividualRelationshipResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTypesIndividualRelationship extends EditRecord
{
    protected static string $resource = TypesIndividualRelationshipResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
