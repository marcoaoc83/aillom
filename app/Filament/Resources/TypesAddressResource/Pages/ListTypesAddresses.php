<?php

namespace App\Filament\Resources\TypesAddressResource\Pages;

use App\Filament\Resources\TypesAddressResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTypesAddresses extends ListRecords
{
    protected static string $resource = TypesAddressResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
