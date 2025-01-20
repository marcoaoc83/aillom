<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

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
        $driver = config('database.default'); // Banco de dados em uso (mysql, pgsql, sqlsrv, sqlite)

        // Caminho do arquivo compactado e descompactado
        $compressedPath = database_path('seeders/sql/dump-cep.sql.gz');
        $decompressedPath = database_path('seeders/sql/dump-cep.sql');

        // Verifica se o arquivo descompactado já existe
        if (!file_exists($decompressedPath)) {
            $this->command->info('Descompactando o arquivo SQL...');

            // Comando para descompactar o arquivo
            $process = Process::fromShellCommandline(sprintf('gunzip -c %s > %s', escapeshellarg($compressedPath), escapeshellarg($decompressedPath)));

            try {
                $process->mustRun();
                $this->command->info('Arquivo descompactado com sucesso.');
            } catch (ProcessFailedException $exception) {
                $this->command->error('Falha ao descompactar o arquivo: ' . $exception->getMessage());
                return;
            }
        }

        // Importa o arquivo SQL de acordo com o banco de dados em uso
        $this->command->info('Iniciando a importação do arquivo SQL de CEP...');

        switch ($driver) {
            case 'mysql':
                $this->importForMysql($decompressedPath, $username, $password, $host, $port, $database);
                break;

            case 'pgsql':
                $this->importForPostgresql($decompressedPath, $username, $password, $host, $port, $database);
                break;

            case 'sqlsrv':
                $this->importForSqlServer($decompressedPath, $username, $password, $host, $port, $database);
                break;

            case 'sqlite':
                $this->importForSqlite($decompressedPath, $database);
                break;

            default:
                $this->command->error('Driver de banco de dados não suportado: ' . $driver);
        }
    }

    /**
     * Importa para MySQL.
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
     * Importa para PostgreSQL.
     */
    private function importForPostgresql(string $filePath, string $username, string $password, string $host, string $port, string $database): void
    {
        // Define a variável de ambiente para a senha do PostgreSQL
        putenv("PGPASSWORD={$password}");

        $command = sprintf(
            'psql -U %s -h %s -p %s -d %s -f %s',
            escapeshellarg($username),
            escapeshellarg($host),
            escapeshellarg($port),
            escapeshellarg($database),
            escapeshellarg($filePath)
        );

        $this->runCommand($command, 'PostgreSQL');
    }

    /**
     * Importa para SQL Server.
     */
    private function importForSqlServer(string $filePath, string $username, string $password, string $host, string $port, string $database): void
    {
        // SQLCMD é usado para importar no SQL Server
        $command = sprintf(
            'sqlcmd -S %s,%s -U %s -P %s -d %s -i %s',
            escapeshellarg($host),
            escapeshellarg($port),
            escapeshellarg($username),
            escapeshellarg($password),
            escapeshellarg($database),
            escapeshellarg($filePath)
        );

        $this->runCommand($command, 'SQL Server');
    }

    /**
     * Importa para SQLite.
     */
    private function importForSqlite(string $filePath, string $database): void
    {
        $command = sprintf(
            'sqlite3 %s < %s',
            escapeshellarg($database),
            escapeshellarg($filePath)
        );

        $this->runCommand($command, 'SQLite');
    }

    /**
     * Executa o comando no terminal.
     */
    private function runCommand(string $command, string $driver): void
    {
        $process = Process::fromShellCommandline($command);
        $process->setTimeout(0);

        try {
            $process->mustRun();
            $this->command->info("Importação para {$driver} concluída com sucesso.");
        } catch (ProcessFailedException $exception) {
            $this->command->error("Falha na importação para {$driver}: " . $exception->getMessage());
        }
    }
}
