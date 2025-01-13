<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $driver = DB::getDriverName();

        // Comandos SQL para cada banco
        $queries = $this->getQueriesByDriver($driver);

        // Criar as views
        foreach ($queries as $query) {
            DB::statement($query);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remover as views em ordem reversa
        $views = [
            'level_6_streets',
            'level_5_neighborhoods',
            'level_4_cities',
            'level_3_states',
            'level_2_countries',
            'level_1_planet',
        ];

        foreach ($views as $view) {
            DB::statement("DROP VIEW IF EXISTS {$view}");
        }
    }

    /**
     * Obtem as queries para o banco atual.
     */
    protected function getQueriesByDriver(string $driver): array
    {
        switch ($driver) {
            case 'mysql':
                return $this->getMySQLQueries();
            case 'pgsql':
                return $this->getPostgreSQLQueries();
            case 'sqlsrv':
                return $this->getSQLServerQueries();
            default:
                throw new \Exception("Banco de dados {$driver} não suportado.");
        }
    }

    /**
     * Queries para MySQL.
     */
    protected function getMySQLQueries(): array
    {
        return [
            // Nível 1: Planeta
            "CREATE OR REPLACE VIEW level_1_planet AS
            SELECT * FROM addresses
            WHERE hierarchical_code NOT LIKE '%.%';",

            // Nível 2: Países
            "CREATE OR REPLACE VIEW level_2_countries AS
            SELECT * FROM addresses
            WHERE hierarchical_code LIKE '%.%'
              AND hierarchical_code NOT LIKE '%.%.%';",

            // Nível 3: Estados
            "CREATE OR REPLACE VIEW level_3_states AS
            SELECT * FROM addresses
            WHERE hierarchical_code LIKE '%.%.%'
              AND hierarchical_code NOT LIKE '%.%.%.%';",

            // Nível 4: Cidades
            "CREATE OR REPLACE VIEW level_4_cities AS
            SELECT * FROM addresses
            WHERE hierarchical_code LIKE '%.%.%.%'
              AND hierarchical_code NOT LIKE '%.%.%.%.%';",

            // Nível 5: Bairros
            "CREATE OR REPLACE VIEW level_5_neighborhoods AS
            SELECT * FROM addresses
            WHERE hierarchical_code LIKE '%.%.%.%.%'
              AND hierarchical_code NOT LIKE '%.%.%.%.%.%';",

            // Nível 6: Ruas
            "CREATE OR REPLACE VIEW level_6_streets AS
            SELECT * FROM addresses
            WHERE hierarchical_code LIKE '%.%.%.%.%.%';",
        ];
    }

    /**
     * Queries para PostgreSQL.
     */
    protected function getPostgreSQLQueries(): array
    {
        return [
            // Nível 1: Planeta
            "CREATE OR REPLACE VIEW level_1_planet AS
            SELECT * FROM addresses
            WHERE hierarchical_code NOT LIKE '%%.%%';",

            // Nível 2: Países
            "CREATE OR REPLACE VIEW level_2_countries AS
            SELECT * FROM addresses
            WHERE hierarchical_code LIKE '%%.%%'
              AND hierarchical_code NOT LIKE '%%.%%.%%';",

            // Nível 3: Estados
            "CREATE OR REPLACE VIEW level_3_states AS
            SELECT * FROM addresses
            WHERE hierarchical_code LIKE '%%.%%.%%'
              AND hierarchical_code NOT LIKE '%%.%%.%%.%%';",

            // Nível 4: Cidades
            "CREATE OR REPLACE VIEW level_4_cities AS
            SELECT * FROM addresses
            WHERE hierarchical_code LIKE '%%.%%.%%.%%'
              AND hierarchical_code NOT LIKE '%%.%%.%%.%%.%%';",

            // Nível 5: Bairros
            "CREATE OR REPLACE VIEW level_5_neighborhoods AS
            SELECT * FROM addresses
            WHERE hierarchical_code LIKE '%%.%%.%%.%%.%%'
              AND hierarchical_code NOT LIKE '%%.%%.%%.%%.%%.%%';",

            // Nível 6: Ruas
            "CREATE OR REPLACE VIEW level_6_streets AS
            SELECT * FROM addresses
            WHERE hierarchical_code LIKE '%%.%%.%%.%%.%%.%%';",
        ];
    }

    /**
     * Queries para SQL Server.
     */
    protected function getSQLServerQueries(): array
    {
        return [
            // Nível 1: Planeta
            "CREATE VIEW level_1_planet AS
            SELECT * FROM addresses
            WHERE CHARINDEX('.', hierarchical_code) = 0;",

            // Nível 2: Países
            "CREATE VIEW level_2_countries AS
            SELECT * FROM addresses
            WHERE CHARINDEX('.', hierarchical_code) = LEN(hierarchical_code) - LEN(REPLACE(hierarchical_code, '.', '')) + 1;",

            // Nível 3: Estados
            "CREATE VIEW level_3_states AS
            SELECT * FROM addresses
            WHERE CHARINDEX('.', hierarchical_code) = LEN(hierarchical_code) - LEN(REPLACE(hierarchical_code, '.', '')) + 2;",

            // Nível 4: Cidades
            "CREATE VIEW level_4_cities AS
            SELECT * FROM addresses
            WHERE CHARINDEX('.', hierarchical_code) = LEN(hierarchical_code) - LEN(REPLACE(hierarchical_code, '.', '')) + 3;",

            // Nível 5: Bairros
            "CREATE VIEW level_5_neighborhoods AS
            SELECT * FROM addresses
            WHERE CHARINDEX('.', hierarchical_code) = LEN(hierarchical_code) - LEN(REPLACE(hierarchical_code, '.', '')) + 4;",

            // Nível 6: Ruas
            "CREATE VIEW level_6_streets AS
            SELECT * FROM addresses
            WHERE CHARINDEX('.', hierarchical_code) = LEN(hierarchical_code) - LEN(REPLACE(hierarchical_code, '.', '')) + 5;",
        ];
    }
};
