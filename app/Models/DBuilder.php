<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Log;
class DBuilder extends Model
{
    protected $casts = [
        'columns' => 'array',
        'relationships' => 'array',
    ];
    protected $attributes = [
        'icon' => 'default-icon',
    ];
    protected $table = 'dbuilders';
    protected $fillable = [
        'icon',
        'dbtable',
        'status',
        'navigation_label',
        'navigation_group',
        'navigation_sort',
        'columns',
        'relationships'
    ];

    public function gerarModulos(Model $record)
    {
        try {
            // Converte o registro para JSON
            $json = $record->toJson();

            // Atualiza o comentário da tabela com o JSON
            $tableName = $record->dbtable;
            DB::statement("ALTER TABLE `{$tableName}` COMMENT = '" . addslashes($json) . "'");

            $result = Artisan::call('make:module', [
                '--table' => $tableName,
            ]);



            Notification::make()
                ->title('Módulo gerado com sucesso!')
                ->success()
                ->body("A tabela '{$tableName}' foi processada e o módulo foi gerado com sucesso.")
                ->send();
        } catch (\Exception $e) {
            // Notificação de erro
            Notification::make()
                ->title('Erro ao gerar módulo')
                ->danger()
                ->body('Ocorreu um erro: ' . $e->getMessage())
                ->send();

            // Registra o erro no log
            Log::error('Erro ao gerar módulo: ' . $e->getMessage(), [
                'table' => $record->dbtable,
                'record' => $record,
            ]);
        }
    }

}
