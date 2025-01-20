<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypesIndividualRelationshipTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Passo 1: Inserir os registros SEM inverse_relationship_id
        DB::table('types_individual_relationship')->delete(); // Limpar a tabela antes de inserir

        DB::table('types_individual_relationship')->insert([
            ['id' => 1, 'description' => 'Pai/Mãe', 'inverse_relationship_id' => null, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['id' => 2, 'description' => 'Filho/Filha', 'inverse_relationship_id' => null, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['id' => 3, 'description' => 'Irmão/Irmã', 'inverse_relationship_id' => null, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['id' => 4, 'description' => 'Avô/Avó', 'inverse_relationship_id' => null, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['id' => 5, 'description' => 'Neto/Neta', 'inverse_relationship_id' => null, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['id' => 6, 'description' => 'Tio/Tia', 'inverse_relationship_id' => null, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['id' => 7, 'description' => 'Sobrinho/Sobrinha', 'inverse_relationship_id' => null, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['id' => 8, 'description' => 'Primo/Prima', 'inverse_relationship_id' => null, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['id' => 9, 'description' => 'Cônjuge/Companheiro', 'inverse_relationship_id' => null, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['id' => 10, 'description' => 'Amigo', 'inverse_relationship_id' => null, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['id' => 11, 'description' => 'Colega de Trabalho', 'inverse_relationship_id' => null, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['id' => 12, 'description' => 'Vizinho', 'inverse_relationship_id' => null, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['id' => 13, 'description' => 'Tutor', 'inverse_relationship_id' => null, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['id' => 14, 'description' => 'Enteado', 'inverse_relationship_id' => null, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['id' => 15, 'description' => 'Enteada', 'inverse_relationship_id' => null, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['id' => 16, 'description' => 'Madrasta', 'inverse_relationship_id' => null, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['id' => 17, 'description' => 'Padrasto', 'inverse_relationship_id' => null, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['id' => 18, 'description' => 'Genro/Nora', 'inverse_relationship_id' => null, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['id' => 19, 'description' => 'Cunhado/Cunhada', 'inverse_relationship_id' => null, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['id' => 20, 'description' => 'Tutorado', 'inverse_relationship_id' => null, 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
        ]);

        // Passo 2: Atualizar os valores de inverse_relationship_id
        DB::table('types_individual_relationship')->where('id', 1)->update(['inverse_relationship_id' => 2]);
        DB::table('types_individual_relationship')->where('id', 2)->update(['inverse_relationship_id' => 1]);
        DB::table('types_individual_relationship')->where('id', 3)->update(['inverse_relationship_id' => 3]);
        DB::table('types_individual_relationship')->where('id', 4)->update(['inverse_relationship_id' => 5]);
        DB::table('types_individual_relationship')->where('id', 5)->update(['inverse_relationship_id' => 4]);
        DB::table('types_individual_relationship')->where('id', 6)->update(['inverse_relationship_id' => 7]);
        DB::table('types_individual_relationship')->where('id', 7)->update(['inverse_relationship_id' => 6]);
        DB::table('types_individual_relationship')->where('id', 8)->update(['inverse_relationship_id' => 8]);
        DB::table('types_individual_relationship')->where('id', 9)->update(['inverse_relationship_id' => 9]);
        DB::table('types_individual_relationship')->where('id', 10)->update(['inverse_relationship_id' => 10]);
        DB::table('types_individual_relationship')->where('id', 11)->update(['inverse_relationship_id' => 11]);
        DB::table('types_individual_relationship')->where('id', 12)->update(['inverse_relationship_id' => 12]);
        DB::table('types_individual_relationship')->where('id', 13)->update(['inverse_relationship_id' => 20]);
        DB::table('types_individual_relationship')->where('id', 14)->update(['inverse_relationship_id' => 15]);
        DB::table('types_individual_relationship')->where('id', 15)->update(['inverse_relationship_id' => 14]);
        DB::table('types_individual_relationship')->where('id', 16)->update(['inverse_relationship_id' => 17]);
        DB::table('types_individual_relationship')->where('id', 17)->update(['inverse_relationship_id' => 16]);
        DB::table('types_individual_relationship')->where('id', 18)->update(['inverse_relationship_id' => 19]);
        DB::table('types_individual_relationship')->where('id', 19)->update(['inverse_relationship_id' => 18]);
        DB::table('types_individual_relationship')->where('id', 20)->update(['inverse_relationship_id' => 13]);
    }
}
