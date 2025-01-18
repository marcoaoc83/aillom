<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CompaniesLevelTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('companies_level')->delete();

        DB::table('companies_level')->insert(array (
            0 =>
            array (
                'id' => 1,
            'description' => 'Microempreendedor Individual (MEI)',
                'created_at' => '2025-01-05 19:10:37',
                'updated_at' => '2025-01-05 19:10:37',
                'deleted_at' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
            'description' => 'Microempresa (ME)',
                'created_at' => '2025-01-05 19:10:37',
                'updated_at' => '2025-01-05 19:10:37',
                'deleted_at' => NULL,
            ),
            2 =>
            array (
                'id' => 3,
            'description' => 'Empresa de Pequeno Porte (EPP)',
                'created_at' => '2025-01-05 19:10:37',
                'updated_at' => '2025-01-05 19:10:37',
                'deleted_at' => NULL,
            ),
            3 =>
            array (
                'id' => 4,
                'description' => 'Média Empresa',
                'created_at' => '2025-01-05 19:10:37',
                'updated_at' => '2025-01-05 19:10:37',
                'deleted_at' => NULL,
            ),
            4 =>
            array (
                'id' => 5,
                'description' => 'Grande Empresa',
                'created_at' => '2025-01-05 19:10:37',
                'updated_at' => '2025-01-05 19:10:37',
                'deleted_at' => NULL,
            ),
            5 =>
            array (
                'id' => 6,
                'description' => 'Startup',
                'created_at' => '2025-01-05 19:10:37',
                'updated_at' => '2025-01-05 19:10:37',
                'deleted_at' => NULL,
            ),
            6 =>
            array (
                'id' => 7,
                'description' => 'Multinacional',
                'created_at' => '2025-01-05 19:10:37',
                'updated_at' => '2025-01-05 19:10:37',
                'deleted_at' => NULL,
            ),
            7 =>
            array (
                'id' => 8,
                'description' => 'Empresa Pública',
                'created_at' => '2025-01-05 19:10:37',
                'updated_at' => '2025-01-05 19:10:37',
                'deleted_at' => NULL,
            ),
            8 =>
            array (
                'id' => 9,
                'description' => 'Sociedade de Economia Mista',
                'created_at' => '2025-01-05 19:10:37',
                'updated_at' => '2025-01-05 19:10:37',
                'deleted_at' => NULL,
            ),
            9 =>
            array (
                'id' => 10,
                'description' => 'Autarquia',
                'created_at' => '2025-01-05 19:10:37',
                'updated_at' => '2025-01-05 19:10:37',
                'deleted_at' => NULL,
            ),
            10 =>
            array (
                'id' => 11,
                'description' => 'Cooperativa',
                'created_at' => '2025-01-05 19:10:37',
                'updated_at' => '2025-01-05 19:10:37',
                'deleted_at' => NULL,
            ),
            11 =>
            array (
                'id' => 12,
                'description' => 'Franquia',
                'created_at' => '2025-01-05 19:10:37',
                'updated_at' => '2025-01-05 19:10:37',
                'deleted_at' => NULL,
            ),
        ));


    }
}
