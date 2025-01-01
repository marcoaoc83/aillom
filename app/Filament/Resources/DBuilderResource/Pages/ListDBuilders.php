<?php

namespace App\Filament\Resources\DBuilderResource\Pages;

use App\Filament\Resources\DBuilderResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDBuilders extends ListRecords
{
    protected static string $resource = DBuilderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
