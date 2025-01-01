<?php

namespace App\Filament\Resources\TypesContactResource\Pages;

use App\Filament\Resources\TypesContactResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTypesContact extends EditRecord
{
    protected static string $resource = TypesContactResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
