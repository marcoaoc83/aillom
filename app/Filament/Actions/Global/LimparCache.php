<?php

namespace App\Filament\Actions\Global;

use Illuminate\Support\Facades\Artisan;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class LimparCache
{
    public static function handle()
    {
        try {
            $commands = [
                'config:clear',
                'route:clear',
                'view:clear',
                'optimize:clear',
                'event:clear',
                'clear-compiled',
                'cache:clear',
                'optimize',
                'filament:optimize',

            ];

            foreach ($commands as $command) {
                exec("php artisan {$command}");
                Log::info("php artisan {$command}");
            }

            Notification::make()
                ->title('Cache limpo com sucesso!')
                ->success()
                ->body('Todas as configurações, rotas, visualizações e cache foram limpos.')
                ->send();

        } catch (\Exception $e) {
            Notification::make()
                ->title('Erro ao limpar cache')
                ->danger()
                ->body('Erro ao tentar limpar cache: ' . $e->getMessage())
                ->send();

            Log::error('Erro ao limpar cache: ' . $e->getMessage());
        }
    }
}
