<?php

namespace App\Filament\Resources\IndividualResource\Pages;

use App\Filament\Exports\IndividualExporter;
use App\Filament\Resources\IndividualResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\ExportAction;

class ListIndividuals extends ListRecords
{
    protected static string $resource = IndividualResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ActionGroup::make([
                Actions\CreateAction::make(),
                ExportAction::make()
                    ->exporter(IndividualExporter::class)
                    ->label('Exportar')
                    ->icon('heroicon-o-document-arrow-down')
            ])
        ];
    }
}
