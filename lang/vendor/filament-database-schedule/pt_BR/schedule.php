<?php
return [

    'resource'=>[
        'single' => 'Agendador',
        'plural' => 'Agendamentos',
        'navigation' => 'Configurações',
        'history' => 'Mostrar histórico de execução',
    ],
    'fields' => [
        'command' => 'Comando',
        'arguments' => 'Argumentos',
        'options' => 'Opções',
        'options_with_value' => 'Opções com valor',
        'expression' => 'Expressão cron',
        'log_filename' => 'Arquivo de log',
        'output' => 'Saída',
        'even_in_maintenance_mode' => 'Executar mesmo em modo de manutenção',
        'without_overlapping' => 'Não sobrepor execuções',
        'on_one_server' => 'Executar em apenas um servidor',
        'webhook_before' => 'URL antes',
        'webhook_after' => 'URL depois',
        'email_output' => 'Enviar saída por e-mail',
        'sendmail_success' => 'Enviar e-mail em caso de sucesso na execução do comando',
        'sendmail_error' => 'Enviar e-mail em caso de falha na execução do comando',
        'log_success' => 'Escrever saída do comando no histórico em caso de sucesso na execução do comando',
        'log_error' => 'Escrever saída do comando no histórico em caso de falha na execução do comando',
        'status' => 'Status',
        'actions' => 'Ações',
        'data-type' => 'Tipo de dado',
        'run_in_background' => 'Executar em segundo plano',
        'created_at' => 'Criado em',
        'updated_at' => 'Atualizado em',
        'never' => 'Nunca',
        'environments' => 'Ambientes',
    ],
    'messages' => [
        'no-records-found' => 'Nenhum agendamento encontrado.',
        'save-success' => 'Agendamento salvo com sucesso.',
        'save-error' => 'Erro ao salvar agendamento.',
        'timezone' => 'Todos os agendamentos serão executados no fuso horário: ',
        'select' => 'Selecione um comando',
        'custom' => 'Comando personalizado',
        'custom-command-here' => 'Comando personalizado aqui (e.g. `cat /proc/cpuinfo` or `artisan db:migrate`)',
        'help-cron-expression' => 'Se necessário, clique aqui e use uma ferramenta para facilitar a criação da expressão cron',
        'help-log-filename' => 'Se o arquivo de log for definido, as mensagens de log deste agendamento serão escritas em storage/logs/<log filename>.log',
        'help-type' => 'Múltiplos :type podem ser especificados separados por vírgulas',
        'attention-type-function' => "ATENÇÃO: parâmetros do tipo 'function' são executados antes da execução do agendamento e seu retorno é passado como parâmetro. Use com cuidado, pode quebrar seu job",
        'delete_cronjob' => 'Apagar cronjob',
        'delete_cronjob_confirm' => 'Você realmente deseja apagar o cronjob ":cronjob"?',
    ],
    'status' => [
        'active' => 'Ativo',
        'inactive' => 'Inativo',
        'trashed' => 'Excluído',
    ],
    'buttons' => [
        'inactivate' => 'Inativar',
        'activate' => 'Ativar',
        'history' => 'Histórico',

    ],
    'validation' => [
        'cron' => 'O campo deve ser preenchido no formato de expressão cron.',
        'regex' => __('validation.alpha_dash') . ' ' . 'Vírgula também é permitida.',
    ],
];
