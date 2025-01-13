<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\Individual;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;
    protected static ?string $title = 'Novo Usuário';

    protected  function mutateFormDataBeforeCreate(array $data): array
    {
        $individual = Individual::find($data['individual_id']);
        $data['name'] = $individual?->name ?? 'Sem Nome'; // Preenche o campo name com o nome do Individual

        return $data;
    }
    protected function getRedirectUrl(): string
    {
        // Redireciona para a listagem do recurso após salvar ou editar
        return $this->getResource()::getUrl('index');
    }
}
