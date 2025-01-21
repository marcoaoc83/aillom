<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class IndividualGendersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('individual_genders')->delete();

        DB::table('individual_genders')->insert(array (
            0 =>
            array (
                'id' => 1,
                'description' => 'Masculino',
                'created_at' => '2025-01-06 15:33:40',
                'updated_at' => '2025-01-06 15:33:40',
                'deleted_at' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'description' => 'Feminino',
                'created_at' => '2025-01-06 15:33:40',
                'updated_at' => '2025-01-06 15:33:40',
                'deleted_at' => NULL,
            ),
            2 =>
            array (
                'id' => 3,
                'description' => 'Não-binário',
                'created_at' => '2025-01-06 15:33:40',
                'updated_at' => '2025-01-06 15:33:40',
                'deleted_at' => NULL,
            ),
            3 =>
            array (
                'id' => 4,
                'description' => 'Não informar',
                'created_at' => '2025-01-06 15:33:40',
                'updated_at' => '2025-01-09 19:36:06',
                'deleted_at' => NULL,
            ),
            4 =>
            array (
                'id' => 5,
                'description' => 'Outro',
                'created_at' => '2025-01-06 15:33:40',
                'updated_at' => '2025-01-06 15:33:40',
                'deleted_at' => NULL,
            ),
            5 =>
            array (
                'id' => 6,
                'description' => 'Agênero',
                'created_at' => '2025-01-06 15:33:40',
                'updated_at' => '2025-01-06 15:33:40',
                'deleted_at' => NULL,
            ),
            6 =>
            array (
                'id' => 7,
                'description' => 'Bigênero',
                'created_at' => '2025-01-06 15:33:40',
                'updated_at' => '2025-01-06 15:33:40',
                'deleted_at' => NULL,
            ),
            7 =>
            array (
                'id' => 8,
                'description' => 'Gênero Fluido',
                'created_at' => '2025-01-06 15:33:40',
                'updated_at' => '2025-01-06 15:33:40',
                'deleted_at' => NULL,
            ),
            8 =>
            array (
                'id' => 9,
                'description' => 'Demiboy',
                'created_at' => '2025-01-06 15:33:40',
                'updated_at' => '2025-01-06 15:33:40',
                'deleted_at' => NULL,
            ),
            9 =>
            array (
                'id' => 10,
                'description' => 'Demigirl',
                'created_at' => '2025-01-06 15:33:40',
                'updated_at' => '2025-01-06 15:33:40',
                'deleted_at' => NULL,
            ),
            10 =>
            array (
                'id' => 11,
                'description' => 'Gênero Neutro',
                'created_at' => '2025-01-06 15:33:40',
                'updated_at' => '2025-01-06 15:33:40',
                'deleted_at' => NULL,
            ),
            11 =>
            array (
                'id' => 12,
                'description' => 'Gênero Queer',
                'created_at' => '2025-01-06 15:33:40',
                'updated_at' => '2025-01-06 15:33:40',
                'deleted_at' => NULL,
            ),
            12 =>
            array (
                'id' => 13,
                'description' => 'Two-Spirit',
                'created_at' => '2025-01-06 15:33:40',
                'updated_at' => '2025-01-06 15:33:40',
                'deleted_at' => NULL,
            ),
            13 =>
            array (
                'id' => 14,
                'description' => 'Intersexo',
                'created_at' => '2025-01-06 15:33:40',
                'updated_at' => '2025-01-06 15:33:40',
                'deleted_at' => NULL,
            ),
            14 =>
            array (
                'id' => 15,
                'description' => 'Pangênero',
                'created_at' => '2025-01-06 15:33:40',
                'updated_at' => '2025-01-06 15:33:40',
                'deleted_at' => NULL,
            ),
            15 =>
            array (
                'id' => 16,
                'description' => 'Transmasculino',
                'created_at' => '2025-01-06 15:33:40',
                'updated_at' => '2025-01-06 15:33:40',
                'deleted_at' => NULL,
            ),
            16 =>
            array (
                'id' => 17,
                'description' => 'Transfeminino',
                'created_at' => '2025-01-06 15:33:40',
                'updated_at' => '2025-01-06 15:33:40',
                'deleted_at' => NULL,
            ),
            17 =>
            array (
                'id' => 18,
                'description' => 'Homem Trans',
                'created_at' => '2025-01-06 15:33:40',
                'updated_at' => '2025-01-06 15:33:40',
                'deleted_at' => NULL,
            ),
            18 =>
            array (
                'id' => 19,
                'description' => 'Mulher Trans',
                'created_at' => '2025-01-06 15:33:40',
                'updated_at' => '2025-01-06 15:33:40',
                'deleted_at' => NULL,
            ),
            19 =>
            array (
                'id' => 20,
                'description' => 'Travesti',
                'created_at' => '2025-01-06 15:33:40',
                'updated_at' => '2025-01-06 15:33:40',
                'deleted_at' => NULL,
            ),
            20 =>
            array (
                'id' => 21,
                'description' => 'Genderflux',
                'created_at' => '2025-01-06 15:33:40',
                'updated_at' => '2025-01-06 15:33:40',
                'deleted_at' => NULL,
            ),
            21 =>
            array (
                'id' => 22,
                'description' => 'Andrógino',
                'created_at' => '2025-01-06 15:33:40',
                'updated_at' => '2025-01-06 15:33:40',
                'deleted_at' => NULL,
            ),
            22 =>
            array (
                'id' => 23,
                'description' => 'Neutrois',
                'created_at' => '2025-01-06 15:33:40',
                'updated_at' => '2025-01-06 15:33:40',
                'deleted_at' => NULL,
            ),
            23 =>
            array (
                'id' => 24,
                'description' => 'Questionando',
                'created_at' => '2025-01-06 15:33:40',
                'updated_at' => '2025-01-06 15:33:40',
                'deleted_at' => NULL,
            ),
            24 =>
            array (
                'id' => 25,
                'description' => 'Sem Gênero',
                'created_at' => '2025-01-06 15:33:40',
                'updated_at' => '2025-01-06 15:33:40',
                'deleted_at' => NULL,
            ),
            25 =>
            array (
                'id' => 26,
                'description' => 'Gênero Ausente',
                'created_at' => '2025-01-06 15:33:40',
                'updated_at' => '2025-01-06 15:33:40',
                'deleted_at' => NULL,
            ),
        ));


    }
}
