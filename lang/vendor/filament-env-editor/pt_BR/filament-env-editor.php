<?php

return [
    'navigation' => [
        'group' => 'Sistema',
        'label' => 'Editor .env',
    ],

    'page' => [
        'title' => 'Editor .env',
    ],
    'tabs' => [
        'current-env' => [
            'title' => 'Atual .env',
        ],
        'backups' => [
            'title' => 'Backups',
        ],
    ],
    'actions' => [
        'add' => [
            'title' => 'Adicionar nova Entrada',
            'modalHeading' => 'Adicionar nova Entrada',
            'success' => [
                'title' => 'Chave ":Name" foi escrita com sucesso',
            ],
            'form' => [
                'fields' => [
                    'key' => 'chave',
                    'value' => 'valor',
                    'index' => 'Inserir após a chave existente (opcional)',
                ],
                'helpText' => [
                    'index' => 'Caso você precise inserir esta nova entrada, após uma existente, você pode escolher uma das chaves existentes',
                ],
            ],
        ],
        'edit' => [
            'tooltip' => 'Editar Entrada ":name"',
            'modal' => [
                'text' => 'Editar Entrada',
            ],
        ],
        'delete' => [
            'tooltip' => 'Remover a entrada ":name"',
            'confirm' => [
                'title' => 'Você está prestes a remover permanentemente ":name". Tem certeza da remoção?',
            ],
        ],
        'clear-cache' => [
            'title' => 'Limpar caches',
            'tooltip' => 'Às vezes, o Laravel armazena em cache as variáveis ENV, então você precisa limpar todos os caches ("artisan optimize:clear"), para reler a alteração no .env',
        ],

        'backup' => [
            'title' => 'Criar um novo Backup',
            'success' => [
                'title' => 'Backup foi criado com sucesso',
            ],
        ],
        'download' => [
            'title' => 'Baixar o .env atual',
            'tooltip' => 'Baixar o arquivo de backup ":name"',
        ],
        'upload-backup' => [
            'title' => 'Enviar um arquivo de backup',
        ],
        'show-content' => [
            'modalHeading' => 'Conteúdo bruto do backup ":name"',
            'tooltip' => 'Mostrar conteúdo bruto',
        ],
        'restore-backup' => [
            'confirm' => [
                'title' => 'Você está prestes a restaurar ":name", no lugar do arquivo .env atual. Por favor, confirme sua escolha',
            ],
            'modalSubmit' => 'Restaurar',
            'tooltip' => 'Restaurar ":name" como ENV atual',
        ],
        'delete-backup' => [
            'tooltip' => 'Remover o arquivo de backup ":name"',
            'confirm' => [
                'title' => 'Você está prestes a remover permanentemente o arquivo de backup ":name". Tem certeza da remoção?',
            ],
        ],
    ],
];
