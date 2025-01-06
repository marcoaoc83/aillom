<?php

namespace App\Filament\Resources\IndividualGenderResource\Pages;

use App\Filament\Resources\IndividualGenderResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListIndividualGenders extends ListRecords
{
    protected static string $resource = IndividualGenderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}