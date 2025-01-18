<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class TypesContactTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('types_contact')->delete();

        DB::table('types_contact')->insert(array (
            0 =>
            array (
                'id' => 1,
                'description' => 'E-mail',
                'regex' => '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\\.[a-zA-Z]{2,}$/',
                'mask' => NULL,
                'created_at' => '2024-12-19 02:07:52',
                'updated_at' => '2025-01-03 20:48:31',
                'deleted_at' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'description' => 'Telefone Fixo',
            'regex' => '/\\(\\d{2}\\) \\d{4}-\\d{4}/',
            'mask' => '(99) 9999-9999',
                'created_at' => '2025-01-03 20:46:45',
                'updated_at' => '2025-01-10 20:18:20',
                'deleted_at' => NULL,
            ),
            2 =>
            array (
                'id' => 3,
            'description' => 'Celular (Brasil)',
            'regex' => '/\\(\\d{2}\\) 9 \\d{4}-\\d{4}/',
            'mask' => '(99) 9 9999-9999',
                'created_at' => '2025-01-03 20:46:59',
                'updated_at' => '2025-01-10 20:18:20',
                'deleted_at' => NULL,
            ),
            3 =>
            array (
                'id' => 4,
                'description' => 'WhatsApp',
            'regex' => '/\\(\\d{2}\\) 9 \\d{4}-\\d{4}/',
            'mask' => '(99) 9 9999-9999',
                'created_at' => '2025-01-03 20:47:47',
                'updated_at' => '2025-01-10 20:18:20',
                'deleted_at' => NULL,
            ),
            4 =>
            array (
                'id' => 5,
                'description' => 'Fax',
            'regex' => '/\\(\\d{2}\\) \\d{4}-\\d{4}/',
            'mask' => '(99) 9999-9999',
                'created_at' => '2025-01-03 20:47:54',
                'updated_at' => '2025-01-10 20:18:20',
                'deleted_at' => NULL,
            ),
            5 =>
            array (
                'id' => 6,
                'description' => 'Skype',
                'regex' => '/^[a-zA-Z0-9._-]{3,}$/',
                'mask' => NULL,
                'created_at' => '2025-01-03 20:48:02',
                'updated_at' => '2025-01-03 20:48:02',
                'deleted_at' => NULL,
            ),
            6 =>
            array (
                'id' => 7,
                'description' => 'Telegram',
            'regex' => '/\\(\\d{2}\\) 9 \\d{4}-\\d{4}/',
            'mask' => '(99) 9 9999-9999',
                'created_at' => '2025-01-03 20:48:19',
                'updated_at' => '2025-01-10 20:18:20',
                'deleted_at' => NULL,
            ),
            7 =>
            array (
                'id' => 8,
                'description' => 'Site',
            'regex' => '/^(https?:\\/\\/)?(www\\.)?[a-zA-Z0-9.-]+\\.[a-zA-Z]{2,}(\\/[a-zA-Z0-9._%+-]*)*$/',
                'mask' => NULL,
                'created_at' => '2025-01-03 20:49:24',
                'updated_at' => '2025-01-03 20:49:24',
                'deleted_at' => NULL,
            ),
            8 =>
            array (
                'id' => 9,
                'description' => 'Facebook',
            'regex' => '/^(https?:\\/\\/)?(www\\.)?facebook\\.com\\/[a-zA-Z0-9._-]+$/',
                'mask' => NULL,
                'created_at' => '2025-01-03 20:49:41',
                'updated_at' => '2025-01-03 20:49:41',
                'deleted_at' => NULL,
            ),
            9 =>
            array (
                'id' => 10,
                'description' => 'Instagram',
            'regex' => '/^(https?:\\/\\/)?(www\\.)?instagram\\.com\\/[a-zA-Z0-9._-]+$/',
                'mask' => NULL,
                'created_at' => '2025-01-03 20:49:46',
                'updated_at' => '2025-01-03 20:49:46',
                'deleted_at' => NULL,
            ),
            10 =>
            array (
                'id' => 11,
                'description' => 'LinkedIn',
            'regex' => '/^(https?:\\/\\/)?(www\\.)?linkedin\\.com\\/in\\/[a-zA-Z0-9._-]+$/',
                'mask' => NULL,
                'created_at' => '2025-01-03 20:49:52',
                'updated_at' => '2025-01-03 20:49:52',
                'deleted_at' => NULL,
            ),
        ));


    }
}
