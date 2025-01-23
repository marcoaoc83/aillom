<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Illuminate\Support\Facades\File;
class DumpCepDadosSeeder extends Seeder
{
    public function run(): void
    {
        // Configurações do banco de dados
        $database = config('database.connections.' . config('database.default') . '.database');
        $username = config('database.connections.' . config('database.default') . '.username');
        $password = config('database.connections.' . config('database.default') . '.password');
        $host = config('database.connections.' . config('database.default') . '.host');
        $port = config('database.connections.' . config('database.default') . '.port');
        $driver = config('database.default'); // Driver em uso

        // Caminho do arquivo compactado e descompactado
        $compressedPathCsv = database_path('seeders/csv/addresses.csv.gz');
        $compressedPathSql = database_path('seeders/sql/dump-cep.sql.gz');
        $decompressedPathCsv = database_path('seeders/csv/addresses.csv');
        $decompressedPathSql = database_path('seeders/sql/dump-cep.sql');

        // Garantir que os diretórios de destino existem
        File::ensureDirectoryExists(database_path('seeders/csv'));
        File::ensureDirectoryExists(database_path('seeders/sql'));

        // Descompactar o arquivo CSV, se necessário
        if (!file_exists($decompressedPathCsv)) {
            $this->command->info('Descompactando o arquivo CSV...');
            $processCsv = Process::fromShellCommandline(sprintf('gunzip -c %s > %s', escapeshellarg($compressedPathCsv), escapeshellarg($decompressedPathCsv)));

            try {
                $processCsv->mustRun();
                $this->command->info('Arquivo CSV descompactado com sucesso.');
            } catch (ProcessFailedException $exception) {
                $this->command->error('Falha ao descompactar o arquivo CSV: ' . $exception->getMessage());
                return;
            }
        }

        // Descompactar o arquivo SQL, se necessário
        if (!file_exists($decompressedPathSql)) {
            $this->command->info('Descompactando o arquivo SQL...');
            $processSql = Process::fromShellCommandline(sprintf('gunzip -c %s > %s', escapeshellarg($compressedPathSql), escapeshellarg($decompressedPathSql)));

            try {
                $processSql->mustRun();
                $this->command->info('Arquivo SQL descompactado com sucesso.');
            } catch (ProcessFailedException $exception) {
                $this->command->error('Falha ao descompactar o arquivo SQL: ' . $exception->getMessage());
                return;
            }
        }



        // Importar o arquivo CSV para o banco de dados
        $this->command->info('Iniciando a importação do arquivo de endereços...');
        switch ($driver) {
            case 'mysql':
                $this->importForMysql($decompressedPathSql, $username, $password, $host, $port, $database);
                break;

            case 'pgsql':
                $this->importForPostgresql($compressedPathCsv, $username, $password, $host, $port, $database);
                break;

            case 'sqlsrv':
                $this->importForSqlServer($compressedPathCsv, $username, $password, $host, $port, $database);
                break;

            case 'sqlite':
                $this->importForSqlite($compressedPathCsv, $database);
                break;

            default:
                $this->command->error("Driver de banco de dados não suportado: {$driver}");
        }
    }

    /**
     * Importar para MySQL.
     */
    private function importForMysql(string $filePath, string $username, string $password, string $host, string $port, string $database): void
    {
        $command = sprintf(
            'mysql -u%s -p%s -h%s -P%s %s < %s',
            escapeshellarg($username),
            escapeshellarg($password),
            escapeshellarg($host),
            escapeshellarg($port),
            escapeshellarg($database),
            escapeshellarg($filePath)
        );

        $this->runCommand($command, 'MySQL');
    }



    /**
     * Importar CSV para PostgreSQL.
     */
    private function importForPostgresql(string $filePath, string $username, string $password, string $host, string $port, string $database): void
    {
        // Verificar se o arquivo existe
        if (!file_exists($filePath)) {
            throw new \Exception("O arquivo CSV {$filePath} não foi encontrado.");
        }

        // Comando para desabilitar os gatilhos
        $disableTrigger = sprintf(
            'PGPASSWORD=%s psql -U %s -h %s -p %s -d %s -c "ALTER TABLE addresses DISABLE TRIGGER ALL;"',
            escapeshellarg($password),
            escapeshellarg($username),
            escapeshellarg($host),
            escapeshellarg($port),
            escapeshellarg($database)
        );

        // Comando para importar os dados
        $copyCommand = sprintf(
            'PGPASSWORD=%s psql -U %s -h %s -p %s -d %s -c "\COPY addresses(id, parent_id, description, abbreviation, postal_code, latitude, longitude, ibge_code, area_code, country_code, hierarchical_code, created_at, updated_at, deleted_at) FROM \'%s\' DELIMITER \',\' CSV HEADER;"',
            escapeshellarg($password),
            escapeshellarg($username),
            escapeshellarg($host),
            escapeshellarg($port),
            escapeshellarg($database),
            $filePath
        );

        // Comando para reativar os gatilhos
        $enableTrigger = sprintf(
            'PGPASSWORD=%s psql -U %s -h %s -p %s -d %s -c "ALTER TABLE addresses ENABLE TRIGGER ALL;"',
            escapeshellarg($password),
            escapeshellarg($username),
            escapeshellarg($host),
            escapeshellarg($port),
            escapeshellarg($database)
        );

        // Executar os comandos com mensagens informativas
        $this->runCommand($disableTrigger, 'PostgreSQL', 'Desativando gatilhos para a tabela addresses...');
        $this->runCommand($copyCommand, 'PostgreSQL', 'Importando os dados do arquivo CSV para a tabela addresses...');
        $this->runCommand($enableTrigger, 'PostgreSQL', 'Reativando gatilhos para a tabela addresses...');
    }


    /**
     * Importar CSV para SQL Server.
     */
    private function importForSqlServer(string $filePath, string $username, string $password, string $host, string $port, string $database): void
    {
        $command = sprintf(
            'bcp %s in %s -c -t, -F 2 -S %s,%s -U %s -P %s',
            escapeshellarg($database . '.dbo.addresses'),
            escapeshellarg($filePath),
            escapeshellarg($host),
            escapeshellarg($port),
            escapeshellarg($username),
            escapeshellarg($password)
        );

        $this->runCommand($command, 'SQL Server');
    }

    /**
     * Importar CSV para SQLite.
     */
    private function importForSqlite(string $filePath, string $database): void
    {
        $command = sprintf(
            'sqlite3 %s ".mode csv" ".import %s addresses"',
            escapeshellarg($database),
            escapeshellarg($filePath)
        );

        $this->runCommand($command, 'SQLite');
    }

    /**
     * Executa o comando no terminal.
     */
    private function runCommand(string $command, string $driver, string $info = null): void
    {
        $process = Process::fromShellCommandline($command);
        $process->setTimeout(0);

        try {
            $process->mustRun();
            if ($info)
                $this->command->info($info);
            else
                $this->command->info("Importação para {$driver} concluída com sucesso.");
        } catch (ProcessFailedException $exception) {
            $this->command->error("Falha na importação para {$driver}: " . $exception->getMessage());
            $this->command->line($exception->getProcess()->getOutput());
            $this->command->line($exception->getProcess()->getErrorOutput());
        }
    }
}
