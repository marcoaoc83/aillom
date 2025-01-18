<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class TypesDocumentTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('types_document')->delete();

        DB::table('types_document')->insert(array (
            0 =>
            array (
                'id' => 1,
                'description' => 'RG',
                'entity_type' => 'PF',
                'regex' => NULL,
                'mask' => NULL,
                'created_at' => '2024-12-20 12:03:28',
                'updated_at' => '2024-12-29 21:09:26',
                'deleted_at' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'description' => 'CPF',
                'entity_type' => 'PF',
                'regex' => '/\\d{3}\\.\\d{3}\\.\\d{3}-\\d{2}/',
                'mask' => '999.999.999-99',
                'created_at' => '2025-01-03 20:52:12',
                'updated_at' => '2025-01-09 23:22:48',
                'deleted_at' => NULL,
            ),
            2 =>
            array (
                'id' => 3,
                'description' => 'CNPJ',
                'entity_type' => 'PJ',
                'regex' => '/\\d{2}\\.\\d{3}\\.\\d{3}\\/\\d{4}-\\d{2}/',
                'mask' => '99.999.999/9999-99',
                'created_at' => '2025-01-03 20:52:21',
                'updated_at' => '2025-01-09 19:25:34',
                'deleted_at' => NULL,
            ),
            3 =>
            array (
                'id' => 4,
                'description' => 'CNH ',
                'entity_type' => 'PF',
                'regex' => '/\\d{11}/',
                'mask' => NULL,
                'created_at' => '2025-01-03 20:52:33',
                'updated_at' => '2025-01-09 19:25:52',
                'deleted_at' => NULL,
            ),
            4 =>
            array (
                'id' => 5,
                'description' => 'Passaporte',
                'entity_type' => 'PF',
                'regex' => '/[A-Z]{2}\\d{6}/',
                'mask' => NULL,
                'created_at' => '2025-01-03 20:52:41',
                'updated_at' => '2025-01-09 19:25:52',
                'deleted_at' => NULL,
            ),
            5 =>
            array (
                'id' => 6,
                'description' => 'Título de Eleitor',
                'entity_type' => 'PF',
                'regex' => '/\\d{4} \\d{4} \\d{4}/',
                'mask' => NULL,
                'created_at' => '2025-01-03 20:52:49',
                'updated_at' => '2025-01-03 20:52:49',
                'deleted_at' => NULL,
            ),
            6 =>
            array (
                'id' => 7,
                'description' => 'PIS/PASEP',
                'entity_type' => 'PF',
                'regex' => '/\\d{3}\\.\\d{5}\\.\\d{2}-\\d{1}/',
                'mask' => NULL,
                'created_at' => '2025-01-03 20:52:58',
                'updated_at' => '2025-01-03 20:52:58',
                'deleted_at' => NULL,
            ),
            7 =>
            array (
                'id' => 8,
                'description' => 'Certidão de Nascimento',
                'entity_type' => 'PF',
                'regex' => NULL,
                'mask' => NULL,
                'created_at' => '2025-01-03 20:53:45',
                'updated_at' => '2025-01-03 20:53:45',
                'deleted_at' => NULL,
            ),
            8 =>
            array (
                'id' => 9,
                'description' => 'Certidão de Casamento',
                'entity_type' => 'PF',
                'regex' => NULL,
                'mask' => NULL,
                'created_at' => '2025-01-03 20:54:02',
                'updated_at' => '2025-01-03 20:54:02',
                'deleted_at' => NULL,
            ),
            9 =>
            array (
                'id' => 10,
                'description' => 'Carteira de Trabalho',
                'entity_type' => 'PF',
                'regex' => '/\\d{5}-\\d{4}/',
                'mask' => NULL,
                'created_at' => '2025-01-03 20:54:11',
                'updated_at' => '2025-01-03 20:54:11',
                'deleted_at' => NULL,
            ),
            10 =>
            array (
                'id' => 11,
                'description' => 'Reservista',
                'entity_type' => 'PF',
                'regex' => '/\\d{9}-\\d{1}/',
                'mask' => NULL,
                'created_at' => '2025-01-03 20:54:21',
                'updated_at' => '2025-01-03 20:54:21',
                'deleted_at' => NULL,
            ),
            11 =>
            array (
                'id' => 12,
                'description' => 'RA',
                'entity_type' => 'PF',
                'regex' => NULL,
                'mask' => NULL,
                'created_at' => '2025-01-03 20:54:29',
                'updated_at' => '2025-01-03 20:54:29',
                'deleted_at' => NULL,
            ),
            12 =>
            array (
                'id' => 13,
                'description' => 'Carteira Profissional',
                'entity_type' => 'PF',
                'regex' => '/\\d{6}-[A-Z]{2}/',
                'mask' => NULL,
                'created_at' => '2025-01-03 20:54:44',
                'updated_at' => '2025-01-03 20:57:14',
                'deleted_at' => NULL,
            ),
            13 =>
            array (
                'id' => 14,
                'description' => 'Inscrição Estadual ',
                'entity_type' => 'PJ',
                'regex' => '/\\d{3}\\.\\d{3}\\.\\d{3}\\.\\d{3}/',
                'mask' => NULL,
                'created_at' => '2025-01-03 20:55:12',
                'updated_at' => '2025-01-03 20:55:12',
                'deleted_at' => NULL,
            ),
            14 =>
            array (
                'id' => 15,
                'description' => 'Inscrição Municipal',
                'entity_type' => 'PJ',
                'regex' => '/\\d{6,9}/',
                'mask' => NULL,
                'created_at' => '2025-01-03 20:55:24',
                'updated_at' => '2025-01-03 20:57:08',
                'deleted_at' => NULL,
            ),
            15 =>
            array (
                'id' => 16,
                'description' => 'NIRE',
                'entity_type' => 'PJ',
                'regex' => '/\\d{11}-\\d{1}/',
                'mask' => NULL,
                'created_at' => '2025-01-03 20:55:34',
                'updated_at' => '2025-01-03 20:55:34',
                'deleted_at' => NULL,
            ),
            16 =>
            array (
                'id' => 17,
                'description' => 'Certificado Digital - A1',
                'entity_type' => 'PJ',
                'regex' => NULL,
                'mask' => NULL,
                'created_at' => '2025-01-03 20:56:00',
                'updated_at' => '2025-01-03 20:56:00',
                'deleted_at' => NULL,
            ),
            17 =>
            array (
                'id' => 18,
                'description' => 'Registro de Marca',
                'entity_type' => 'PJ',
                'regex' => NULL,
                'mask' => NULL,
                'created_at' => '2025-01-03 20:56:14',
                'updated_at' => '2025-01-03 20:56:14',
                'deleted_at' => NULL,
            ),
            18 =>
            array (
                'id' => 19,
                'description' => 'Alvará de Funcionamento',
                'entity_type' => 'PJ',
                'regex' => NULL,
                'mask' => NULL,
                'created_at' => '2025-01-03 20:56:38',
                'updated_at' => '2025-01-03 20:56:38',
                'deleted_at' => NULL,
            ),
        ));


    }
}
