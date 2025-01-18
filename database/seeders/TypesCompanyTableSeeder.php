<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class TypesCompanyTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('types_company')->delete();

        DB::table('types_company')->insert(array (
            0 =>
            array (
                'id' => 1,
                'code' => '213-5',
                'description' => 'Empresário Individual',
                'created_at' => '2025-01-05 19:06:38',
                'updated_at' => '2025-01-05 19:06:38',
                'deleted_at' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'code' => '206-2',
                'description' => 'Sociedade Empresária Limitada',
                'created_at' => '2025-01-05 19:06:38',
                'updated_at' => '2025-01-05 19:06:38',
                'deleted_at' => NULL,
            ),
            2 =>
            array (
                'id' => 3,
                'code' => '223-2',
                'description' => 'Sociedade Anônima Fechada',
                'created_at' => '2025-01-05 19:06:38',
                'updated_at' => '2025-01-05 19:06:38',
                'deleted_at' => NULL,
            ),
            3 =>
            array (
                'id' => 4,
                'code' => '224-0',
                'description' => 'Sociedade Anônima Aberta',
                'created_at' => '2025-01-05 19:06:38',
                'updated_at' => '2025-01-05 19:06:38',
                'deleted_at' => NULL,
            ),
            4 =>
            array (
                'id' => 5,
                'code' => '230-5',
                'description' => 'Sociedade em Nome Coletivo',
                'created_at' => '2025-01-05 19:06:38',
                'updated_at' => '2025-01-05 19:06:38',
                'deleted_at' => NULL,
            ),
            5 =>
            array (
                'id' => 6,
                'code' => '231-3',
                'description' => 'Sociedade em Comandita Simples',
                'created_at' => '2025-01-05 19:06:38',
                'updated_at' => '2025-01-05 19:06:38',
                'deleted_at' => NULL,
            ),
            6 =>
            array (
                'id' => 7,
                'code' => '232-1',
                'description' => 'Sociedade em Comandita por Ações',
                'created_at' => '2025-01-05 19:06:38',
                'updated_at' => '2025-01-05 19:06:38',
                'deleted_at' => NULL,
            ),
            7 =>
            array (
                'id' => 8,
                'code' => '233-0',
                'description' => 'Cooperativa',
                'created_at' => '2025-01-05 19:06:38',
                'updated_at' => '2025-01-05 19:06:38',
                'deleted_at' => NULL,
            ),
            8 =>
            array (
                'id' => 9,
                'code' => '234-8',
                'description' => 'Consórcio de Empresas',
                'created_at' => '2025-01-05 19:06:38',
                'updated_at' => '2025-01-05 19:06:38',
                'deleted_at' => NULL,
            ),
            9 =>
            array (
                'id' => 10,
                'code' => '235-6',
                'description' => 'Grupo de Sociedades',
                'created_at' => '2025-01-05 19:06:38',
                'updated_at' => '2025-01-05 19:06:38',
                'deleted_at' => NULL,
            ),
            10 =>
            array (
                'id' => 11,
                'code' => '236-4',
                'description' => 'Empresa Binacional',
                'created_at' => '2025-01-05 19:06:38',
                'updated_at' => '2025-01-05 19:06:38',
                'deleted_at' => NULL,
            ),
            11 =>
            array (
                'id' => 12,
                'code' => '237-2',
                'description' => 'Consórcio Simples',
                'created_at' => '2025-01-05 19:06:38',
                'updated_at' => '2025-01-05 19:06:38',
                'deleted_at' => NULL,
            ),
            12 =>
            array (
                'id' => 13,
                'code' => '254-0',
            'description' => 'Sociedade Limitada Unipessoal (SLU)',
                'created_at' => '2025-01-05 19:06:38',
                'updated_at' => '2025-01-05 19:06:38',
                'deleted_at' => NULL,
            ),
            13 =>
            array (
                'id' => 14,
                'code' => '101-5',
                'description' => 'Órgão Público do Poder Executivo Federal',
                'created_at' => '2025-01-05 19:06:38',
                'updated_at' => '2025-01-05 19:06:38',
                'deleted_at' => NULL,
            ),
            14 =>
            array (
                'id' => 15,
                'code' => '102-3',
                'description' => 'Órgão Público do Poder Executivo Estadual ou do Distrito Federal',
                'created_at' => '2025-01-05 19:06:38',
                'updated_at' => '2025-01-05 19:06:38',
                'deleted_at' => NULL,
            ),
            15 =>
            array (
                'id' => 16,
                'code' => '103-1',
                'description' => 'Órgão Público do Poder Executivo Municipal',
                'created_at' => '2025-01-05 19:06:38',
                'updated_at' => '2025-01-05 19:06:38',
                'deleted_at' => NULL,
            ),
            16 =>
            array (
                'id' => 17,
                'code' => '104-0',
                'description' => 'Órgão Público do Poder Legislativo Federal',
                'created_at' => '2025-01-05 19:06:38',
                'updated_at' => '2025-01-05 19:06:38',
                'deleted_at' => NULL,
            ),
            17 =>
            array (
                'id' => 18,
                'code' => '105-8',
                'description' => 'Órgão Público do Poder Legislativo Estadual ou do Distrito Federal',
                'created_at' => '2025-01-05 19:06:38',
                'updated_at' => '2025-01-05 19:06:38',
                'deleted_at' => NULL,
            ),
            18 =>
            array (
                'id' => 19,
                'code' => '106-6',
                'description' => 'Órgão Público do Poder Legislativo Municipal',
                'created_at' => '2025-01-05 19:06:38',
                'updated_at' => '2025-01-05 19:06:38',
                'deleted_at' => NULL,
            ),
            19 =>
            array (
                'id' => 20,
                'code' => '107-4',
                'description' => 'Órgão Público do Poder Judiciário Federal',
                'created_at' => '2025-01-05 19:06:38',
                'updated_at' => '2025-01-05 19:06:38',
                'deleted_at' => NULL,
            ),
            20 =>
            array (
                'id' => 21,
                'code' => '108-2',
                'description' => 'Órgão Público do Poder Judiciário Estadual',
                'created_at' => '2025-01-05 19:06:38',
                'updated_at' => '2025-01-05 19:06:38',
                'deleted_at' => NULL,
            ),
            21 =>
            array (
                'id' => 22,
                'code' => '116-3',
                'description' => 'Autarquia Federal',
                'created_at' => '2025-01-05 19:06:38',
                'updated_at' => '2025-01-05 19:06:38',
                'deleted_at' => NULL,
            ),
            22 =>
            array (
                'id' => 23,
                'code' => '117-1',
                'description' => 'Autarquia Estadual ou do Distrito Federal',
                'created_at' => '2025-01-05 19:06:38',
                'updated_at' => '2025-01-05 19:06:38',
                'deleted_at' => NULL,
            ),
            23 =>
            array (
                'id' => 24,
                'code' => '118-0',
                'description' => 'Autarquia Municipal',
                'created_at' => '2025-01-05 19:06:38',
                'updated_at' => '2025-01-05 19:06:38',
                'deleted_at' => NULL,
            ),
            24 =>
            array (
                'id' => 25,
                'code' => '119-8',
                'description' => 'Fundação Pública de Direito Público Federal',
                'created_at' => '2025-01-05 19:06:38',
                'updated_at' => '2025-01-05 19:06:38',
                'deleted_at' => NULL,
            ),
            25 =>
            array (
                'id' => 26,
                'code' => '120-1',
                'description' => 'Fundação Pública de Direito Público Estadual ou do Distrito Federal',
                'created_at' => '2025-01-05 19:06:38',
                'updated_at' => '2025-01-05 19:06:38',
                'deleted_at' => NULL,
            ),
            26 =>
            array (
                'id' => 27,
                'code' => '121-0',
                'description' => 'Fundação Pública de Direito Público Municipal',
                'created_at' => '2025-01-05 19:06:38',
                'updated_at' => '2025-01-05 19:06:38',
                'deleted_at' => NULL,
            ),
            27 =>
            array (
                'id' => 28,
                'code' => '124-4',
                'description' => 'Empresa Pública',
                'created_at' => '2025-01-05 19:06:38',
                'updated_at' => '2025-01-05 19:06:38',
                'deleted_at' => NULL,
            ),
            28 =>
            array (
                'id' => 29,
                'code' => '125-2',
                'description' => 'Sociedade de Economia Mista',
                'created_at' => '2025-01-05 19:06:38',
                'updated_at' => '2025-01-05 19:06:38',
                'deleted_at' => NULL,
            ),
            29 =>
            array (
                'id' => 30,
                'code' => '301-3',
                'description' => 'Associação Privada',
                'created_at' => '2025-01-05 19:06:38',
                'updated_at' => '2025-01-05 19:06:38',
                'deleted_at' => NULL,
            ),
            30 =>
            array (
                'id' => 31,
                'code' => '308-0',
            'description' => 'Organização Social (OS)',
                'created_at' => '2025-01-05 19:06:38',
                'updated_at' => '2025-01-05 19:06:38',
                'deleted_at' => NULL,
            ),
            31 =>
            array (
                'id' => 32,
                'code' => '310-2',
                'description' => 'Fundação Privada',
                'created_at' => '2025-01-05 19:06:38',
                'updated_at' => '2025-01-05 19:06:38',
                'deleted_at' => NULL,
            ),
            32 =>
            array (
                'id' => 33,
                'code' => '320-7',
                'description' => 'Entidade Sindical',
                'created_at' => '2025-01-05 19:06:38',
                'updated_at' => '2025-01-05 19:06:38',
                'deleted_at' => NULL,
            ),
            33 =>
            array (
                'id' => 34,
                'code' => '322-3',
                'description' => 'Organização Religiosa',
                'created_at' => '2025-01-05 19:06:38',
                'updated_at' => '2025-01-05 19:06:38',
                'deleted_at' => NULL,
            ),
            34 =>
            array (
                'id' => 35,
                'code' => '201-1',
                'description' => 'Empresa Domiciliada no Exterior',
                'created_at' => '2025-01-05 19:06:38',
                'updated_at' => '2025-01-05 19:06:38',
                'deleted_at' => NULL,
            ),
            35 =>
            array (
                'id' => 36,
                'code' => '501-0',
                'description' => 'Representação Diplomática Estrangeira',
                'created_at' => '2025-01-05 19:06:38',
                'updated_at' => '2025-01-05 19:06:38',
                'deleted_at' => NULL,
            ),
            36 =>
            array (
                'id' => 37,
                'code' => '502-8',
                'description' => 'Organização Internacional',
                'created_at' => '2025-01-05 19:06:38',
                'updated_at' => '2025-01-05 19:06:38',
                'deleted_at' => NULL,
            ),
            37 =>
            array (
                'id' => 38,
                'code' => '503-6',
                'description' => 'Representação de Organismo Internacional e Outras Instituições Extraterritoriais',
                'created_at' => '2025-01-05 19:06:38',
                'updated_at' => '2025-01-05 19:06:38',
                'deleted_at' => NULL,
            ),
            38 =>
            array (
                'id' => 39,
                'code' => '401-4',
                'description' => 'Empresa Individual Imobiliária',
                'created_at' => '2025-01-05 19:06:38',
                'updated_at' => '2025-01-05 19:06:38',
                'deleted_at' => NULL,
            ),
            39 =>
            array (
                'id' => 40,
                'code' => '402-2',
            'description' => 'Segurado Especial (Produtor Rural)',
                'created_at' => '2025-01-05 19:06:38',
                'updated_at' => '2025-01-05 19:06:38',
                'deleted_at' => NULL,
            ),
            40 =>
            array (
                'id' => 41,
                'code' => '408-1',
                'description' => 'Contribuinte Individual',
                'created_at' => '2025-01-05 19:06:38',
                'updated_at' => '2025-01-05 19:06:38',
                'deleted_at' => NULL,
            ),
            41 =>
            array (
                'id' => 42,
                'code' => '113-0',
                'description' => 'Consórcio Público',
                'created_at' => '2025-01-05 19:06:38',
                'updated_at' => '2025-01-05 19:06:38',
                'deleted_at' => NULL,
            ),
        ));


    }
}
