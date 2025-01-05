<?php

namespace App\Filament\Resources\TypesCompanyResource\Pages;

use App\Filament\Resources\TypesCompanyResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTypesCompany extends EditRecord
{
    protected static string $resource = TypesCompanyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
