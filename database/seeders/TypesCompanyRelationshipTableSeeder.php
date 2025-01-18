<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class TypesCompanyRelationshipTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('types_company_relationship')->delete();

        DB::table('types_company_relationship')->insert(array (
            0 =>
            array (
                'id' => 1,
                'description' => 'Sócio',
                'created_at' => '2025-01-05 20:26:43',
                'updated_at' => '2025-01-05 20:26:43',
                'deleted_at' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'description' => 'Empregado',
                'created_at' => '2025-01-05 20:26:43',
                'updated_at' => '2025-01-05 20:26:43',
                'deleted_at' => NULL,
            ),
            2 =>
            array (
                'id' => 3,
                'description' => 'Investidor',
                'created_at' => '2025-01-05 20:26:43',
                'updated_at' => '2025-01-05 20:26:43',
                'deleted_at' => NULL,
            ),
            3 =>
            array (
                'id' => 4,
                'description' => 'Fornecedor',
                'created_at' => '2025-01-05 20:26:43',
                'updated_at' => '2025-01-05 20:26:43',
                'deleted_at' => NULL,
            ),
            4 =>
            array (
                'id' => 5,
                'description' => 'Cliente',
                'created_at' => '2025-01-05 20:26:43',
                'updated_at' => '2025-01-05 20:26:43',
                'deleted_at' => NULL,
            ),
            5 =>
            array (
                'id' => 6,
                'description' => 'Consultor Externo',
                'created_at' => '2025-01-05 20:26:43',
                'updated_at' => '2025-01-05 20:26:43',
                'deleted_at' => NULL,
            ),
            6 =>
            array (
                'id' => 7,
                'description' => 'Prestador de Serviço',
                'created_at' => '2025-01-05 20:26:43',
                'updated_at' => '2025-01-05 20:26:43',
                'deleted_at' => NULL,
            ),
            7 =>
            array (
                'id' => 8,
                'description' => 'Parceiro',
                'created_at' => '2025-01-05 20:26:43',
                'updated_at' => '2025-01-05 20:26:43',
                'deleted_at' => NULL,
            ),
            8 =>
            array (
                'id' => 9,
                'description' => 'Estagiário',
                'created_at' => '2025-01-05 20:26:43',
                'updated_at' => '2025-01-05 20:26:43',
                'deleted_at' => NULL,
            ),
            9 =>
            array (
                'id' => 10,
                'description' => 'Autônomo',
                'created_at' => '2025-01-05 20:26:43',
                'updated_at' => '2025-01-05 20:26:43',
                'deleted_at' => NULL,
            ),
            10 =>
            array (
                'id' => 11,
                'description' => 'Voluntário',
                'created_at' => '2025-01-05 20:26:43',
                'updated_at' => '2025-01-05 20:26:43',
                'deleted_at' => NULL,
            ),
            11 =>
            array (
                'id' => 12,
                'description' => 'Terceirizado',
                'created_at' => '2025-01-05 20:26:43',
                'updated_at' => '2025-01-05 20:26:43',
                'deleted_at' => NULL,
            ),
            12 =>
            array (
                'id' => 13,
                'description' => 'Servidor',
                'created_at' => '2025-01-05 20:26:43',
                'updated_at' => '2025-01-05 20:26:43',
                'deleted_at' => NULL,
            ),
            13 =>
            array (
                'id' => 14,
                'description' => 'Comissionado',
                'created_at' => '2025-01-05 20:26:43',
                'updated_at' => '2025-01-05 20:26:43',
                'deleted_at' => NULL,
            ),
            14 =>
            array (
                'id' => 15,
                'description' => 'Aposentado',
                'created_at' => '2025-01-05 20:26:43',
                'updated_at' => '2025-01-05 20:26:43',
                'deleted_at' => NULL,
            ),
            15 =>
            array (
                'id' => 16,
                'description' => 'Ex-Funcionário',
                'created_at' => '2025-01-05 20:26:43',
                'updated_at' => '2025-01-05 20:26:43',
                'deleted_at' => NULL,
            ),
        ));


    }
}
