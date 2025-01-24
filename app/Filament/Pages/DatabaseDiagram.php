<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseDiagram extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-group';

    protected static string $view = 'filament.pages.database-diagram';
    protected static ?string $navigationLabel = 'Diagrama';
    protected static ?string $navigationGroup = 'Developer';
    protected static ?string $title = 'Diagrama';

    protected static ?int $navigationSort = 78;

    public $mermaidDiagram = '';

    public function mount()
    {
        $this->mermaidDiagram = $this->generateMermaidDiagram();
    }

    private function generateMermaidDiagram()
    {
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
            'level_1_planet',
            'level_2_countries',
            'level_3_states',
            'level_4_cities',
            'level_5_neighborhoods',
            'level_6_streets',
            'notifications',
            'exports',
            'imports',
            'failed_import_rows',
        ];

        $tables = $this->getTables();
        $mermaid = "erDiagram\n";

        foreach ($tables as $tableName) {
            if (in_array($tableName, $excludedTables)) {
                continue;
            }

            // Obter colunas
            $columns = Schema::getColumnListing($tableName);
            $mermaid .= "  $tableName {\n";
            foreach ($columns as $column) {
                $mermaid .= "    string $column\n"; // Substitua por tipos reais, se necessário
            }
            $mermaid .= "  }\n";

            // Obter relacionamentos
            $foreignKeys = $this->getForeignKeys($tableName);
            foreach ($foreignKeys as $fk) {
                $mermaid .= "  {$fk->referenced_table} ||--o{ $tableName : \"has many\"\n";
            }
        }

        return $mermaid;
    }

    private function getTables()
    {
        $databaseDriver = DB::getDriverName();
        $tables = [];

        switch ($databaseDriver) {
            case 'mysql':
                $tables = DB::select('SHOW TABLES');
                return array_map(fn($table) => array_values((array)$table)[0], $tables);

            case 'pgsql':
                $tables = DB::select("SELECT tablename FROM pg_tables WHERE schemaname = 'public'");
                return array_column($tables, 'tablename');

            case 'sqlite':
                $tables = DB::select("SELECT name FROM sqlite_master WHERE type='table'");
                return array_column($tables, 'name');

            case 'sqlsrv':
                $tables = DB::select("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE'");
                return array_column($tables, 'TABLE_NAME');

            default:
                throw new \Exception("Driver não suportado: $databaseDriver");
        }
    }

    private function getForeignKeys($tableName)
    {
        $databaseDriver = DB::getDriverName();

        switch ($databaseDriver) {
            case 'mysql':
                return DB::select("
                    SELECT
                        COLUMN_NAME AS column_name,
                        REFERENCED_TABLE_NAME AS referenced_table,
                        REFERENCED_COLUMN_NAME AS referenced_column
                    FROM
                        INFORMATION_SCHEMA.KEY_COLUMN_USAGE
                    WHERE
                        TABLE_NAME = '$tableName' AND
                        REFERENCED_TABLE_NAME IS NOT NULL;
                ");

            case 'pgsql':
                return DB::select("
                    SELECT
                        kcu.column_name AS column_name,
                        ccu.table_name AS referenced_table,
                        ccu.column_name AS referenced_column
                    FROM
                        information_schema.table_constraints AS tc
                        JOIN information_schema.key_column_usage AS kcu
                          ON tc.constraint_name = kcu.constraint_name
                          AND tc.table_schema = kcu.table_schema
                        JOIN information_schema.constraint_column_usage AS ccu
                          ON ccu.constraint_name = tc.constraint_name
                    WHERE
                        tc.constraint_type = 'FOREIGN KEY' AND
                        tc.table_name = '$tableName';
                ");

            case 'sqlite':
                return DB::select("PRAGMA foreign_key_list('$tableName')");

            case 'sqlsrv':
                return DB::select("
                    SELECT
                        fk.COLUMN_NAME AS column_name,
                        pk.TABLE_NAME AS referenced_table,
                        pk.COLUMN_NAME AS referenced_column
                    FROM
                        INFORMATION_SCHEMA.REFERENTIAL_CONSTRAINTS AS rc
                        JOIN INFORMATION_SCHEMA.KEY_COLUMN_USAGE AS fk
                          ON rc.CONSTRAINT_NAME = fk.CONSTRAINT_NAME
                        JOIN INFORMATION_SCHEMA.KEY_COLUMN_USAGE AS pk
                          ON rc.UNIQUE_CONSTRAINT_NAME = pk.CONSTRAINT_NAME
                    WHERE
                        fk.TABLE_NAME = '$tableName';
                ");

            default:
                throw new \Exception("Driver não suportado: $databaseDriver");
        }
    }
}
