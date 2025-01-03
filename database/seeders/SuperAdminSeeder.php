<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        // Cria o super admin (ou encontra um existente)
        $user = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('12345')
            ]
        );

        // Cria o role super_admin caso não exista
        $superAdminRole = Role::firstOrCreate(['name' => 'super_admin']);

        // Atribui a role ao usuário
        $user->assignRole($superAdminRole);
    }
}
