<?php

namespace App\Filament\Resources\CompaniesLevelResource\Pages;

use App\Filament\Resources\CompaniesLevelResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCompaniesLevel extends EditRecord
{
    protected static string $resource = CompaniesLevelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
