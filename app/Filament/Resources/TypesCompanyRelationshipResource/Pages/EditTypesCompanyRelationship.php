<?php

namespace App\Filament\Resources\TypesCompanyRelationshipResource\Pages;

use App\Filament\Resources\TypesCompanyRelationshipResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTypesCompanyRelationship extends EditRecord
{
    protected static string $resource = TypesCompanyRelationshipResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
