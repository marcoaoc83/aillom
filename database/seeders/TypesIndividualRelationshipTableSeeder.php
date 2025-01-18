<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class TypesIndividualRelationshipTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('types_individual_relationship')->delete();

        DB::table('types_individual_relationship')->insert(array (
            0 =>
            array (
                'id' => 1,
                'description' => 'Pai/Mãe',
                'inverse_relationship_id' => 2,
                'created_at' => '2025-01-09 20:12:06',
                'updated_at' => '2025-01-09 20:12:06',
                'deleted_at' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'description' => 'Filho/Filha',
                'inverse_relationship_id' => 1,
                'created_at' => '2025-01-09 20:12:06',
                'updated_at' => '2025-01-09 20:12:06',
                'deleted_at' => NULL,
            ),
            2 =>
            array (
                'id' => 3,
                'description' => 'Irmão/Irmã',
                'inverse_relationship_id' => 3,
                'created_at' => '2025-01-09 20:12:06',
                'updated_at' => '2025-01-09 20:12:06',
                'deleted_at' => NULL,
            ),
            3 =>
            array (
                'id' => 4,
                'description' => 'Avô/Avó',
                'inverse_relationship_id' => 5,
                'created_at' => '2025-01-09 20:12:06',
                'updated_at' => '2025-01-09 20:12:06',
                'deleted_at' => NULL,
            ),
            4 =>
            array (
                'id' => 5,
                'description' => 'Neto/Neta',
                'inverse_relationship_id' => 4,
                'created_at' => '2025-01-09 20:12:06',
                'updated_at' => '2025-01-09 20:12:06',
                'deleted_at' => NULL,
            ),
            5 =>
            array (
                'id' => 6,
                'description' => 'Tio/Tia',
                'inverse_relationship_id' => 7,
                'created_at' => '2025-01-09 20:12:06',
                'updated_at' => '2025-01-09 20:12:06',
                'deleted_at' => NULL,
            ),
            6 =>
            array (
                'id' => 7,
                'description' => 'Sobrinho/Sobrinha',
                'inverse_relationship_id' => 6,
                'created_at' => '2025-01-09 20:12:06',
                'updated_at' => '2025-01-09 20:12:06',
                'deleted_at' => NULL,
            ),
            7 =>
            array (
                'id' => 8,
                'description' => 'Primo/Prima',
                'inverse_relationship_id' => 8,
                'created_at' => '2025-01-09 20:12:06',
                'updated_at' => '2025-01-09 20:12:06',
                'deleted_at' => NULL,
            ),
            8 =>
            array (
                'id' => 9,
                'description' => 'Cônjuge/Companheiro',
                'inverse_relationship_id' => 9,
                'created_at' => '2025-01-09 20:12:06',
                'updated_at' => '2025-01-09 20:12:06',
                'deleted_at' => NULL,
            ),
            9 =>
            array (
                'id' => 10,
                'description' => 'Amigo',
                'inverse_relationship_id' => 10,
                'created_at' => '2025-01-09 20:12:06',
                'updated_at' => '2025-01-09 20:12:49',
                'deleted_at' => NULL,
            ),
            10 =>
            array (
                'id' => 11,
                'description' => 'Colega de Trabalho',
                'inverse_relationship_id' => 11,
                'created_at' => '2025-01-09 20:12:06',
                'updated_at' => '2025-01-09 20:12:49',
                'deleted_at' => NULL,
            ),
            11 =>
            array (
                'id' => 12,
                'description' => 'Vizinho',
                'inverse_relationship_id' => 12,
                'created_at' => '2025-01-09 20:12:06',
                'updated_at' => '2025-01-09 20:12:49',
                'deleted_at' => NULL,
            ),
            12 =>
            array (
                'id' => 13,
                'description' => 'Tutor',
                'inverse_relationship_id' => 20,
                'created_at' => '2025-01-09 20:12:06',
                'updated_at' => '2025-01-09 20:13:43',
                'deleted_at' => NULL,
            ),
            13 =>
            array (
                'id' => 14,
                'description' => 'Enteado',
                'inverse_relationship_id' => 15,
                'created_at' => '2025-01-09 20:12:06',
                'updated_at' => '2025-01-09 20:12:06',
                'deleted_at' => NULL,
            ),
            14 =>
            array (
                'id' => 15,
                'description' => 'Enteada',
                'inverse_relationship_id' => 14,
                'created_at' => '2025-01-09 20:12:06',
                'updated_at' => '2025-01-09 20:12:06',
                'deleted_at' => NULL,
            ),
            15 =>
            array (
                'id' => 16,
                'description' => 'Madrasta',
                'inverse_relationship_id' => 17,
                'created_at' => '2025-01-09 20:12:06',
                'updated_at' => '2025-01-09 20:12:06',
                'deleted_at' => NULL,
            ),
            16 =>
            array (
                'id' => 17,
                'description' => 'Padrasto',
                'inverse_relationship_id' => 16,
                'created_at' => '2025-01-09 20:12:06',
                'updated_at' => '2025-01-09 20:12:06',
                'deleted_at' => NULL,
            ),
            17 =>
            array (
                'id' => 18,
                'description' => 'Genro/Nora',
                'inverse_relationship_id' => 19,
                'created_at' => '2025-01-09 20:12:06',
                'updated_at' => '2025-01-09 20:12:06',
                'deleted_at' => NULL,
            ),
            18 =>
            array (
                'id' => 19,
                'description' => 'Cunhado/Cunhada',
                'inverse_relationship_id' => 18,
                'created_at' => '2025-01-09 20:12:06',
                'updated_at' => '2025-01-09 20:12:06',
                'deleted_at' => NULL,
            ),
            19 =>
            array (
                'id' => 20,
                'description' => 'Tutorado ',
                'inverse_relationship_id' => 13,
                'created_at' => '2025-01-09 20:13:39',
                'updated_at' => '2025-01-09 20:13:39',
                'deleted_at' => NULL,
            ),
        ));


    }
}
