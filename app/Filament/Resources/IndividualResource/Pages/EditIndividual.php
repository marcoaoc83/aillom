<?php

namespace App\Filament\Resources\IndividualResource\Pages;

use App\Filament\Resources\IndividualResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditIndividual extends EditRecord
{
    protected static string $resource = IndividualResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function getContentTabLabel(): ?string
    {
        return 'Dados';
    }

    public function hasCombinedRelationManagerTabsWithContent(): bool
    {
        return true;
    }
    protected function mutateRelationshipDataBeforeSaveUsing(array $data): array
    {
        if (isset($data['users'])) {
            foreach ($data['users'] as &$user) {
                $individual = \App\Models\Individual::find($data['id']);
                $user['name'] = $individual?->name ?? 'Sem Nome';
            }
        }
        dd($data);
        return $data;
    }
}
