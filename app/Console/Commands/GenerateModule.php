<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class GenerateModule extends Command
{
    protected $signature = 'make:module {--table= : Nome da tabela específica} {--prefix= : Prefixo das tabelas}';
    protected $description = 'Gera módulos completos  Model, Resource) com base nas tabelas ou prefixo.';

    public function handle()
    {
        $table = $this->option('table');
        $prefix = $this->option('prefix');

        if (!$table && !$prefix) {
            $this->error("Você deve fornecer o parâmetro --table ou --prefix.");
            return;
        }

        if ($table) {
            $this->generateModuleForTable($table);
        } elseif ($prefix) {
            $tables = $this->getTablesByPrefix($prefix);
            if (empty($tables)) {
                $this->error("Nenhuma tabela encontrada com o prefixo '{$prefix}'.");
                return;
            }

            foreach ($tables as $tableName) {
                $this->generateModuleForTable($tableName);
            }
        }

    }

    private function getTablesByPrefix($prefix)
    {
        $query = "SHOW TABLES LIKE '{$prefix}%'";
        return collect(DB::select($query))->map(fn($table) => reset($table))->toArray();
    }

    private function generateModuleForTable($table)
    {
        $metadata = $this->getTableDescription($table);

        if (!$metadata) {
            $this->error("A tabela '{$table}' não possui metadados na descrição.");
            return;
        }

        $this->info("Gerando módulo para a tabela '{$table}'...");

        $modelName = Str::studly(Str::singular($table));

        $this->createFullModule($modelName, $table, $metadata);

    }


    private function getTableDescription($table)
    {
        $description = DB::selectOne("SELECT TABLE_COMMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = ?", [$table]);
        return json_decode($description->TABLE_COMMENT, true);
    }

    private function customizeFilamentResource($resourceName, $metadata, $modelName)
    {
        $path = app_path("Filament/Resources/{$resourceName}.php");

        if (!file_exists($path)) {
            $this->error("O arquivo do resource '{$resourceName}' não foi encontrado.");
            return;
        }


        // Campos do Formulário
        $tableColumns = [];
        $formFields = [];
        foreach ($metadata['columns'] as $column) {
            $label = $column['label'] ?? ucfirst($column['name']);
            $type = $column['type'] ?? 'input';

            // Configurações extras
            $required = $column['required'] ?? false;
            $nullable = false;
            $maxLength = isset($column['max_length']) ? "->maxLength({$column['max_length']})" : '';
            $default = isset($column['default']) ? "->default('{$column['default']}')" : '';

            switch ($type) {
                case 'input':
                    $formFields[] = "\Filament\Forms\Components\TextInput::make('{$column['name']}')"
                        . "->label('{$label}')"
                        . ($required ? "->required()" : "")
                        . ($nullable ? "->nullable()" : "")
                        . $maxLength
                        . $default;
                    break;

                case 'textarea':
                    $formFields[] = "\Filament\Forms\Components\Textarea::make('{$column['name']}')"
                        . "->label('{$label}')"
                        . ($required ? "->required()" : "")
                        . ($nullable ? "->nullable()" : "")
                        . $maxLength
                        . $default;
                    break;

                case 'select':
                    $formFields[] = "\Filament\Forms\Components\Select::make('{$column['name']}')"
                        . "->label('{$label}')"
                        . "->options([])"
                        . ($required ? "->required()" : "")
                        . ($nullable ? "->nullable()" : "")
                        . $default;
                    break;

                case 'toggle':
                    $formFields[] = "\Filament\Forms\Components\Toggle::make('{$column['name']}')"
                        . "->label('{$label}')"
                        . ($required ? "->required()" : "")
                        . ($nullable ? "->nullable()" : "")
                        . $default;
                    break;

                case 'file_upload':
                    $formFields[] = "\Filament\Forms\Components\FileUpload::make('{$column['name']}')"
                        . "->label('{$label}')"
                        . ($required ? "->required()" : "")
                        . ($nullable ? "->nullable()" : "")
                        . $default;
                    break;

                case 'multi_select':
                    $formFields[] = "\Filament\Forms\Components\MultiSelect::make('{$column['name']}')"
                        . "->label('{$label}')"
                        . "->options([])"
                        . ($required ? "->required()" : "")
                        . ($nullable ? "->nullable()" : "")
                        . $default;
                    break;

                case 'radio':
                    $formFields[] = "\Filament\Forms\Components\Radio::make('{$column['name']}')"
                        . "->label('{$label}')"
                        . "->options([])"
                        . ($required ? "->required()" : "")
                        . ($nullable ? "->nullable()" : "")
                        . $default;
                    break;

                case 'date_picker':
                    $formFields[] = "\Filament\Forms\Components\DatePicker::make('{$column['name']}')"
                        . "->label('{$label}')"
                        . ($required ? "->required()" : "")
                        . ($nullable ? "->nullable()" : "")
                        . $default;
                    break;

                case 'time_picker':
                    $formFields[] = "\Filament\Forms\Components\TimePicker::make('{$column['name']}')"
                        . "->label('{$label}')"
                        . ($required ? "->required()" : "")
                        . ($nullable ? "->nullable()" : "")
                        . $default;
                    break;

                case 'datetime_picker':
                    $formFields[] = "\Filament\Forms\Components\DateTimePicker::make('{$column['name']}')"
                        . "->label('{$label}')"
                        . ($required ? "->required()" : "")
                        . ($nullable ? "->nullable()" : "")
                        . $default;
                    break;

                case 'color_picker':
                    $formFields[] = "\Filament\Forms\Components\ColorPicker::make('{$column['name']}')"
                        . "->label('{$label}')"
                        . ($required ? "->required()" : "")
                        . ($nullable ? "->nullable()" : "")
                        . $default;
                    break;

                case 'key_value':
                    $formFields[] = "\Filament\Forms\Components\KeyValue::make('{$column['name']}')"
                        . "->label('{$label}')"
                        . ($required ? "->required()" : "")
                        . ($nullable ? "->nullable()" : "")
                        . $default;
                    break;

                case 'markdown_editor':
                    $formFields[] = "\Filament\Forms\Components\MarkdownEditor::make('{$column['name']}')"
                        . "->label('{$label}')"
                        . ($required ? "->required()" : "")
                        . ($nullable ? "->nullable()" : "")
                        . $default;
                    break;

                case 'rich_editor':
                    $formFields[] = "\Filament\Forms\Components\RichEditor::make('{$column['name']}')"
                        . "->label('{$label}')"
                        . ($required ? "->required()" : "")
                        . ($nullable ? "->nullable()" : "")
                        . $default;
                    break;

                case 'repeater':
                    $formFields[] = "\Filament\Forms\Components\Repeater::make('{$column['name']}')"
                        . "->label('{$label}')"
                        . "->schema([])"
                        . ($required ? "->required()" : "")
                        . ($nullable ? "->nullable()" : "")
                        . $default;
                    break;

                case 'builder':
                    $formFields[] = "\Filament\Forms\Components\Builder::make('{$column['name']}')"
                        . "->label('{$label}')"
                        . "->blocks([])"
                        . ($required ? "->required()" : "")
                        . ($nullable ? "->nullable()" : "")
                        . $default;
                    break;

                case 'tags_input':
                    $formFields[] = "\Filament\Forms\Components\TagsInput::make('{$column['name']}')"
                        . "->label('{$label}')"
                        . ($required ? "->required()" : "")
                        . ($nullable ? "->nullable()" : "")
                        . $default;
                    break;

                case 'hidden':
                    $formFields[] = "\Filament\Forms\Components\Hidden::make('{$column['name']}')"
                        . ($nullable ? "->nullable()" : "")
                        . $default;
                    break;

                case 'html':
                    $formFields[] = "\Filament\Forms\Components\Html::make('{$column['name']}')"
                        . "->label('{$label}')"
                        . "->html('')";
                    break;

                case 'view':
                    $formFields[] = "\Filament\Forms\Components\View::make('{$column['name']}')"
                        . "->view('')";
                    break;

                default:
                    $formFields[] = "\Filament\Forms\Components\TextInput::make('{$column['name']}')"
                        . "->label('{$label}')"
                        . ($required ? "->required()" : "")
                        . ($nullable ? "->nullable()" : "")
                        . $maxLength
                        . $default;
                    break;
            }

            // Adicionar colunas à listagem se `$column['list']` for true
            if (!empty($column['list'])) {
                $tableColumns[] = "\Filament\Tables\Columns\TextColumn::make('{$column['name']}')"
                    . "->label('{$label}')";
            }
        }

        // Montar Tabs do Formulário
        $tabs = "\Filament\Forms\Components\Tabs::make('Detalhes')\n"
            . "    ->tabs([\n"
            . "        \Filament\Forms\Components\Tabs\Tab::make('Informações')\n"
            . "            ->schema([\n"
            . implode(",\n                ", $formFields)
            . "\n            ]),\n"
            . "    ])";

        // Montar colunas da tabela
        $tableSchema = implode(",\n            ", $tableColumns);

        // Substituições no arquivo do Resource
        $fileContents = file_get_contents($path);


        // Substituir o modelo
        $fileContents = preg_replace(
            '/protected static \?string \$model = .*?;/',
            "protected static ?string \$model = \\App\\Models\\" . ucfirst(Str::singular($modelName)) . "::class;",
            $fileContents
        );

        // Substituir o navigationIcon
        $fileContents = preg_replace(
            '/protected static \?string \$navigationIcon = .*?;/',
            "protected static ?string \$navigationIcon = '" . $metadata['icon'] . "';",
            $fileContents
        );

        // Substituir ou adicionar o navigationGroup
        if (preg_match('/protected static \?string \$navigationGroup = .*?;/', $fileContents)) {
            // Substitui o valor existente
            $fileContents = preg_replace(
                '/protected static \?string \$navigationGroup = .*?;/',
                "protected static ?string \$navigationGroup = '" . addslashes($metadata['navigation_group'] ?? 'Gerenciamento') . "';",
                $fileContents
            );
        } else {
            // Adiciona a propriedade após a declaração da classe
            $fileContents = preg_replace(
                '/(class\s+\w+\s+extends\s+Resource\s*\{)/',
                "$1\n\n    protected static ?string \$navigationGroup = '" . addslashes($metadata['navigation_group'] ?? 'Gerenciamento') . "';",
                $fileContents
            );
        }

        if (!preg_match('/protected static \?int \$navigationSort/', $fileContents)) {
            $navigationSort = $metadata['navigation_sort'] ?? 0;
            $fileContents = preg_replace(
                '/(class\s+\w+\s+extends\s+Resource\s*\{)/',
                "$1\n\n    protected static ?int \$navigationSort = {$navigationSort};",
                $fileContents
            );
        }

        if (!preg_match('/protected static \?string \$label/', $fileContents)) {
            $label = $metadata['navigation_label'] ?? ucfirst(str_replace('_', ' ', $modelName));
            $fileContents = preg_replace(
                '/(class\s+\w+\s+extends\s+Resource\s*\{)/',
                "$1\n\n    protected static ?string \$label = '" . addslashes($label) . "';",
                $fileContents
            );
        }


        // Substituir o método form
        $fileContents = preg_replace(
            '/public static function form\(.*?\{.*?\}/s',
            "public static function form(Forms\\Form \$form): Forms\\Form {\n        return \$form->schema([\n            {$tabs}\n        ]);\n    }",
            $fileContents
        );


        // Substituir ou adicionar o método table
        if (str_contains($fileContents, 'public static function table(')) {
            $fileContents = preg_replace(
                '/public static function table\(.*?\{.*?\}/s',
                "public static function table(Tables\\Table \$table): Tables\\Table {\n        return \$table->columns([\n            {$tableSchema}\n        ]);\n    }",
                $fileContents
            );
        } else {
            $fileContents = preg_replace(
                '/(class\s+\w+\s+extends\s+Resource\s*\{)/',
                "$1\n\n    public static function table(Tables\\Table \$table): Tables\\Table {\n        return \$table->columns([\n            {$tableSchema}\n        ]);\n    }",
                $fileContents
            );
        }

        // Garante que a classe estenda BaseResource
        $fileContents = preg_replace(
            '/extends\s+Resource/',
            'extends BaseResource',
            $fileContents
        );
        file_put_contents($path, $fileContents);

        $this->info("Resource '{$resourceName}' atualizado com sucesso!");
    }

    private function createActionFolder($modelName)
    {
        $actionPath = app_path("Filament/Actions/{$modelName}");

        // Cria o diretório, se não existir
        if (!File::exists($actionPath)) {
            File::makeDirectory($actionPath, 0755, true);
            $this->info("Pasta de actions '{$modelName}' criada com sucesso.");
        } else {
            $this->warn("A pasta '{$modelName}' já existe.");
        }
    }
    private function createModelOnly($modelName, $table, $metadata)
    {
        $modelPath = app_path("Models/{$modelName}.php");

        if (File::exists($modelPath)) {
            $this->warn("Model [{$modelName}] já existe. Pulando...");
            return;
        }

        $this->call('make:model', ['name' => $modelName]);

        $fillable = collect($metadata['columns'])->pluck('name')->toArray();
        $fillableString = implode("', '", $fillable);

        $modelContents = file_get_contents($modelPath);
        $fillableBlock = "protected \$fillable = ['{$fillableString}'];\n";
        $tableBlock = "protected \$table = '{$table}';\n";

        $modelContents = preg_replace(
            '/class\s+' . $modelName . '\s+extends\s+Model\s*\{/',
            "class {$modelName} extends Model {\n    {$fillableBlock}    {$tableBlock}",
            $modelContents
        );

        file_put_contents($modelPath, $modelContents);

        $this->info("Model '{$modelName}' gerado com sucesso!");
    }

    private function createFullModule($modelName, $table, $metadata)
    {
        $modelPath = app_path("Models/{$modelName}.php");

        if (!File::exists($modelPath)) {
            $this->call('make:model', ['name' => $modelName]);
        } else {
            $this->warn("Model [{$modelName}] já existe.");
        }

        $resourceName = "{$modelName}Resource";
        $resourcePath = app_path("Filament/Resources/{$resourceName}.php");

        // Criar ou sobrescrever o Filament Resource
        $this->call('make:filament-resource', ['name' => $resourceName]);

        if (File::exists($resourcePath)) {
            $this->customizeFilamentResource($resourceName, $metadata, $modelName);
        }

        $this->info("Módulo '{$modelName}' gerado com sucesso!");
    }


}
