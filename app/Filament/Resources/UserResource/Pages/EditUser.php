<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\Individual;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;
    protected static ?string $title = 'Edição de Usuário';
    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected  function mutateFormDataBeforeSave(array $data): array
    {
        $individual = Individual::find($data['individual_id']);
        $data['name'] = $individual?->name ?? 'Sem Nome';

        return $data;
    }
    protected function getRedirectUrl(): string
    {
        // Redireciona para a listagem do recurso após salvar ou editar
        return $this->getResource()::getUrl('index');
    }
}
