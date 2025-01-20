<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(DumpCepDadosSeeder::class);
        $this->call(TypesAddressTableSeeder::class);
        $this->call(TypesCompanyTableSeeder::class);
        $this->call(TypesCompanyRelationshipTableSeeder::class);
        $this->call(TypesContactTableSeeder::class);
        $this->call(TypesDocumentTableSeeder::class);
        $this->call(TypesIndividualRelationshipTableSeeder::class);
        $this->call(CompaniesLevelTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(SuperAdminSeeder::class);

        $this->command->info('DatabaseSeeder concluído com sucesso!');
    }
}
