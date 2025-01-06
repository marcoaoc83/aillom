<?php

namespace App\Filament\Actions\Global;

use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class AtualizarPagina
{
    public static function handle()
    {
        try {
            Notification::make()
                ->title('Atualizando Página...')
                ->success()
                ->body('A página será recarregada em breve.')
                ->send();

            redirect(request()->header('Referer'));

        } catch (\Exception $e) {
            Notification::make()
                ->title('Erro ao atualizar página')
                ->danger()
                ->body('Não foi possível recarregar a página: ' . $e->getMessage())
                ->send();

            Log::error('Erro ao atualizar página: ' . $e->getMessage());
        }
    }
}
