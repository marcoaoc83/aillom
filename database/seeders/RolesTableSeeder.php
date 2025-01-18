<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('roles')->delete();

        DB::table('roles')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'super_admin',
                'guard_name' => 'web',
                'created_at' => '2025-01-10 13:45:40',
                'updated_at' => '2025-01-10 13:45:40',
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'Administrador',
                'guard_name' => 'web',
                'created_at' => '2025-01-10 13:47:49',
                'updated_at' => '2025-01-10 13:47:49',
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'Comum',
                'guard_name' => 'web',
                'created_at' => '2025-01-10 13:48:20',
                'updated_at' => '2025-01-10 13:48:20',
            ),
        ));


    }
}
