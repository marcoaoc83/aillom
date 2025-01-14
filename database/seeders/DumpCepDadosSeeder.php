<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class DumpCepDadosSeeder extends Seeder
{
    public function run(): void
    {
        // Caminho do arquivo SQL
        $path = database_path('seeders/sql/dump-cep.sql');

        // Configurações do banco de dados
        $database = config('database.connections.mysql.database');
        $username = config('database.connections.mysql.username');
        $password = config('database.connections.mysql.password');
        $host = config('database.connections.mysql.host');
        $port = config('database.connections.mysql.port');

        // Monta o comando para importar o SQL
        $command = [
            'mysql',
            "-u{$username}",
            "-p{$password}",
            "-h{$host}",
            "-P{$port}",
            $database,
            "-e",
            "source {$path}"
        ];

        // Executa o processo
        $process = new Process($command);
        $process->setTimeout(0); // Desativa timeout

        try {
            $process->mustRun();
            $this->command->info('Arquivo SQL CEP importado com sucesso.');
        } catch (ProcessFailedException $exception) {
            $this->command->error('Falha ao importar o arquivo SQL: ' . $exception->getMessage());
        } finally {
            $this->command->line($process->getOutput());
            $this->command->line($process->getErrorOutput());
        }

    }
}
