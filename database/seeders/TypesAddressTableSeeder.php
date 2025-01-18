<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypesAddressTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('types_address')->delete();

        DB::table('types_address')->insert(array (
            0 =>
            array (
                'id' => 1,
                'description' => 'Residencial',
                'created_at' => '2025-01-03 21:38:50',
                'updated_at' => '2025-01-03 21:38:50',
                'deleted_at' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'description' => 'Comercial',
                'created_at' => '2025-01-03 21:38:53',
                'updated_at' => '2025-01-03 21:38:53',
                'deleted_at' => NULL,
            ),
            2 =>
            array (
                'id' => 3,
                'description' => 'Rural',
                'created_at' => '2025-01-03 21:39:04',
                'updated_at' => '2025-01-03 21:39:04',
                'deleted_at' => NULL,
            ),
            3 =>
            array (
                'id' => 4,
                'description' => 'Correspondência',
                'created_at' => '2025-01-03 21:39:10',
                'updated_at' => '2025-01-03 21:39:10',
                'deleted_at' => NULL,
            ),
            4 =>
            array (
                'id' => 5,
                'description' => 'Cobrança/Faturamento',
                'created_at' => '2025-01-03 21:39:21',
                'updated_at' => '2025-01-03 21:39:21',
                'deleted_at' => NULL,
            ),
            5 =>
            array (
                'id' => 6,
                'description' => 'Entrega',
                'created_at' => '2025-01-03 21:39:25',
                'updated_at' => '2025-01-03 21:39:25',
                'deleted_at' => NULL,
            ),
            6 =>
            array (
                'id' => 7,
                'description' => 'Fiscal',
                'created_at' => '2025-01-03 21:39:31',
                'updated_at' => '2025-01-03 21:39:31',
                'deleted_at' => NULL,
            ),
            7 =>
            array (
                'id' => 8,
                'description' => 'Filial',
                'created_at' => '2025-01-03 21:39:36',
                'updated_at' => '2025-01-03 21:39:36',
                'deleted_at' => NULL,
            ),
            8 =>
            array (
                'id' => 9,
                'description' => 'Caixa Postal',
                'created_at' => '2025-01-03 21:39:43',
                'updated_at' => '2025-01-03 21:39:43',
                'deleted_at' => NULL,
            ),
            9 =>
            array (
                'id' => 10,
                'description' => 'Logística',
                'created_at' => '2025-01-03 21:39:49',
                'updated_at' => '2025-01-03 21:39:49',
                'deleted_at' => NULL,
            ),
            10 =>
            array (
                'id' => 11,
                'description' => 'Ponto de Coleta/Retirada',
                'created_at' => '2025-01-03 21:40:11',
                'updated_at' => '2025-01-03 21:40:11',
                'deleted_at' => NULL,
            ),
            11 =>
            array (
                'id' => 12,
                'description' => 'Principal',
                'created_at' => '2025-01-03 21:40:28',
                'updated_at' => '2025-01-03 21:40:28',
                'deleted_at' => NULL,
            ),
            12 =>
            array (
                'id' => 13,
                'description' => 'Secundário',
                'created_at' => '2025-01-03 21:40:32',
                'updated_at' => '2025-01-03 21:40:32',
                'deleted_at' => NULL,
            ),
        ));


    }
}
