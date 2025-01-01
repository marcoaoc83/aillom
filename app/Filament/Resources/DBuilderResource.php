<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DBuilderResource\Pages;
//use App\Filament\Resources\DBuilderResource\RelationManagers;
use App\Models\DBuilder;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Guava\FilamentIconPicker\Forms\IconPicker;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class DBuilderResource extends BaseResource
{
    protected static ?string $model = DBuilder::class;
    protected static ?string $navigationLabel = 'DBuilder';
    protected static ?string $navigationIcon = 'heroicon-o-cog';
    protected static ?string $navigationGroup = 'Configurações';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Tabs::make('Detalhes')
                ->tabs([
                    // Aba para configurações gerais
                    Forms\Components\Tabs\Tab::make('Geral')
                        ->schema([
                            Forms\Components\Grid::make(1) // 1 coluna na linha
                            ->schema([

                                Forms\Components\Select::make('dbtable')
                                    ->label('Tabela do Banco de Dados')
                                    ->options(function () {
                                        $excludedTables = [
                                            'audits',
                                            'cache',
                                            'cache_locks',
                                            'dbuilders',
                                            'failed_jobs',
                                            'job_batches',
                                            'jobs',
                                            'migrations',
                                            'model_has_permissions',
                                            'model_has_roles',
                                            'password_reset_tokens',
                                            'permissions',
                                            'pulse_aggregates',
                                            'pulse_entries',
                                            'pulse_values',
                                            'role_has_permissions',
                                            'roles',
                                            'schedule_histories',
                                            'schedules',
                                            'sessions',
                                            'socialite_users',
                                            'telescope_entries',
                                            'telescope_entries_tags',
                                            'telescope_monitoring',
                                            'users',
                                        ];

                                        // Detecta o driver do banco de dados
                                        $driver = DB::getDriverName();

                                        // Query adequada para listar tabelas baseado no driver
                                        switch ($driver) {
                                            case 'mysql':
                                            case 'mariadb':
                                                $query = "SHOW TABLES";
                                                $key = 'Tables_in_' . DB::getDatabaseName();
                                                break;

                                            case 'pgsql':
                                                $query = "SELECT tablename AS table_name FROM pg_catalog.pg_tables WHERE schemaname = 'public'";
                                                $key = 'table_name';
                                                break;

                                            case 'sqlsrv':
                                                $query = "SELECT TABLE_NAME AS table_name FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE'";
                                                $key = 'table_name';
                                                break;

                                            case 'sqlite':
                                                $query = "SELECT name AS table_name FROM sqlite_master WHERE type='table'";
                                                $key = 'table_name';
                                                break;

                                            default:
                                                throw new \Exception("Driver de banco de dados não suportado: {$driver}");
                                        }

                                        // Executa a query e obtém as tabelas
                                        $tables = collect(DB::select($query))
                                            ->map(fn($table) => $table->$key) // Extrai o nome correto da tabela
                                            ->reject(fn($table) => in_array($table, $excludedTables)) // Exclui as tabelas indesejadas
                                            ->mapWithKeys(fn($table) => [$table => ucfirst(str_replace('_', ' ', $table))]) // Formata os nomes
                                            ->toArray();

                                        return $tables;
                                    })
                                    ->required()
                                    ->reactive() // Torna o campo reativo
                                    ->live() // Força a atualização em tempo real

                            ]),

                            // Linha 2: Campos `navigation_label` e `icon` lado a lado
                            Forms\Components\Grid::make(12) // 2 colunas na linha
                            ->schema([
                                Forms\Components\TextInput::make('navigation_label')
                                    ->label('Nome')
                                    ->columnSpan(8)
                                    ->required(),
                                IconPicker::make('icon')
                                    ->label('Ícone')
                                    ->columnSpan(4)
                                    ->required(),
                            ]),

                            // Linha 3: Campos `navigation_group` e `navigation_sort` lado a lado
                            Forms\Components\Grid::make(12) // 2 colunas na linha
                            ->schema([
                                Forms\Components\TextInput::make('navigation_group')
                                    ->label('Grupo do Menu')
                                    ->columnSpan(8)
                                    ->required(),
                                Forms\Components\TextInput::make('navigation_sort')
                                    ->label('Ordem do Menu')
                                    ->numeric()
                                    ->default(1)
                                    ->columnSpan(4)
                                    ->required(),
                            ]),
                        ])->extraAttributes([
                            'class' => 'bg-gray-100',
                        ]),

                    // Aba para as colunas
                    Forms\Components\Tabs\Tab::make('Colunas')
                        ->schema([
                            Forms\Components\Repeater::make('columns')
                                ->label('Colunas')
                                ->schema([
                                    // Nome e Rótulo
                                    Forms\Components\Grid::make(12)
                                        ->schema([
                                            Forms\Components\Select::make('name')
                                                ->label('Nome do Campo - (name)')
                                                ->options(function (callable $get) { // $get é injetado automaticamente

                                                    $table = $get('../../dbtable');


                                                    if (!$table) {
                                                        return []; // Retorna vazio
                                                    }
                                                    if (!Schema::hasTable($table)) {
                                                        return []; // Retorna vazio se a tabela não existir
                                                    }
                                                    if (!$table || !Schema::hasTable($table)) {
                                                        return []; // Retorna vazio se nenhuma tabela for selecionada ou não existir
                                                    }
                                                    // Obtém as colunas da tabela usando o Schema Builder
                                                    return collect(Schema::getColumnListing($table))
                                                        ->mapWithKeys(fn($column) => [$column => $column])
                                                        ->toArray();
                                                })
                                                ->required()
                                                ->reactive()
                                                ->columnSpan(6),

                                            Forms\Components\TextInput::make('label')
                                                ->label('Título - (label)')
                                                ->required()
                                                ->columnSpan(6),
                                        ]),

                                    // Tipo do Componente
                                    Forms\Components\Grid::make(12)
                                        ->schema([
                                            Forms\Components\Select::make('type')
                                                ->label('Tipo de Componente')
                                                ->options([
                                                    'input' => 'TextInput (Texto)',
                                                    'textarea' => 'Textarea',
                                                    'select' => 'Select (Dropdown)',
                                                    'multi_select' => 'MultiSelect',
                                                    'checkbox' => 'Checkbox',
                                                    'radio' => 'Radio',
                                                    'toggle' => 'Toggle (Interruptor)',
                                                    'file_upload' => 'FileUpload (Upload de Arquivo)',
                                                    'image_upload' => 'ImageUpload (Upload de Imagem)',
                                                    'date_picker' => 'DatePicker (Data)',
                                                    'time_picker' => 'TimePicker (Hora)',
                                                    'datetime_picker' => 'DateTimePicker (Data e Hora)',
                                                    'color_picker' => 'ColorPicker (Cor)',
                                                    'key_value' => 'KeyValue (Chave/Valor)',
                                                    'markdown_editor' => 'MarkdownEditor',
                                                    'rich_editor' => 'RichEditor (Editor de Texto Rico)',
                                                    'repeater' => 'Repeater (Lista Repetitiva)',
                                                    'builder' => 'Builder (Editor de Blocos)',
                                                    'tags_input' => 'TagsInput (Tags)',
                                                    'hidden' => 'Hidden (Oculto)',
                                                    'html' => 'HTML (Texto Estático)',
                                                    'view' => 'View (Customizado)',
                                                ])
                                                ->required()
                                                ->columnSpan(12),
                                        ]),

                                    // Configurações Extras: Obrigatório, Limite de Caracteres, Valor Padrão, Permitir Nulo
                                    Forms\Components\Grid::make(12)
                                        ->schema([
                                            Forms\Components\TextInput::make('max_length')
                                                ->label('Limite de Caracteres')
                                                ->numeric()
                                                ->nullable()
                                                ->columnSpan(2),

                                            Forms\Components\TextInput::make('default')
                                                ->label('Valor Padrão')
                                                ->nullable()
                                                ->columnSpan(4  ),
                                            Forms\Components\Toggle::make('required')
                                                ->label('Obrigatório')
                                                ->columnSpan(2)
                                                ->extraAttributes([
                                                    'class' => 'flex items-center h-full', // Classe para centralizar o toggle
                                                ]),

                                            Forms\Components\Toggle::make('list')
                                                ->label('Listagem')
                                                ->columnSpan(2)
                                                ->extraAttributes([
                                                    'class' => 'flex items-center h-full', // Classe para centralizar o toggle
                                                ]),



                                        ]),
                                ])
                                ->defaultItems(0)
                                ->minItems(0)
                                ->required(),
                            ])
                        ->extraAttributes([
                            'class' => 'bg-gray-100',
                        ]),

                    // Aba para os relacionamentos
                    Forms\Components\Tabs\Tab::make('Relacionamentos')
                        ->schema([
                            Forms\Components\Repeater::make('relationships')
                                ->label('Relacionamentos')
                                ->schema([
                                    Forms\Components\Select::make('type')
                                        ->label('Tipo')
                                        ->options([
                                            'n:n' => 'Muitos para Muitos (n:n)',
                                            '1:n' => 'Um para Muitos (1:n)',
                                        ])
                                        ->required(),

                                    Forms\Components\TextInput::make('label')
                                        ->label('Rótulo')
                                        ->required(),

                                    Forms\Components\Select::make('relation_table')
                                        ->label('Tabela Relacionada')
                                        ->options(fn () => collect(DB::select('SHOW TABLES'))->mapWithKeys(function ($table) {
                                            $tableName = array_values((array) $table)[0];
                                            return [$tableName => ucfirst(str_replace('_', ' ', $tableName))];
                                        })->toArray())
                                        ->searchable()
                                        ->required(),

                                    Forms\Components\Select::make('pivot_table')
                                        ->label('Tabela Pivô')
                                        ->options(fn () => collect(DB::select('SHOW TABLES'))->mapWithKeys(function ($table) {
                                            $tableName = array_values((array) $table)[0];
                                            return [$tableName => ucfirst(str_replace('_', ' ', $tableName))];
                                        })->toArray())
                                        ->searchable()
                                        ->nullable(),

                                    Forms\Components\Repeater::make('pivot_columns')
                                        ->label('Colunas da Tabela Pivô')
                                        ->schema([
                                            Forms\Components\TextInput::make('name')
                                                ->label('Nome')
                                                ->required(),

                                            Forms\Components\TextInput::make('label')
                                                ->label('Rótulo')
                                                ->required(),
                                        ])
                                        ->defaultItems(0)
                                        ->minItems(0)
                                        ->nullable(),
                                ])
                                ->defaultItems(0)
                                ->minItems(0)
                                ->nullable(),
                        ])->extraAttributes([
                            'class' => 'bg-gray-100',
                        ]) ,

                ]) ->columnSpan(12),
        ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('navigation_label')->label('Nome'),
                Tables\Columns\TextColumn::make('dbtable')->label('Tabela'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('executarFuncao')
                    ->label('Executar')
                    ->icon('heroicon-o-play') // Ícone opcional
                    ->action(function (Model $record) {
                        $record->gerarModulos($record);
                        session()->flash('success', 'Função executada com sucesso!');
                    })
                    ->requiresConfirmation() // Requer confirmação antes de executar
                    ->color('primary'), // Cor do botão
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDBuilders::route('/'),
            'create' => Pages\CreateDBuilder::route('/create'),
            'edit' => Pages\EditDBuilder::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string
    {
        return 'DBuilder'; // Nome singular
    }

    public static function getPluralModelLabel(): string
    {
        return 'DBuilders'; // Nome plural
    }

}
