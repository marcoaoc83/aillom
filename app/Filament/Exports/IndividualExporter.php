<?php

namespace App\Filament\Exports;

use App\Models\Individual;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class IndividualExporter extends Exporter
{
    protected static ?string $model = Individual::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('name'),
            ExportColumn::make('birth_date'),
            ExportColumn::make('death_date'),
            ExportColumn::make('sex'),
            ExportColumn::make('gender_id'),
            ExportColumn::make('nationality'),
            ExportColumn::make('birth_place_id'),
            ExportColumn::make('naturalness_id'),
            ExportColumn::make('social_name'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
            ExportColumn::make('deleted_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Sua exportação de pessoas foi concluída e ' . number_format($export->successful_rows, 0, ',', '.') . ' ' . str('linha')->plural($export->successful_rows) . ' foram exportadas com sucesso.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount, 0, ',', '.') . ' ' . str('linha')->plural($failedRowsCount) . ' falharam na exportação.';
        }

        return $body;
    }

}
