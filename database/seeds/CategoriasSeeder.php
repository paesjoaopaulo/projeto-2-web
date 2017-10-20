<?php

use Illuminate\Database\Seeder;

class CategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cats = [
            0 => [
                'id' => 1,
                'nome' => 'Linguagens de Programação',
                'descricao' => '',
                'categoria_id' => null,
            ],
            1 => [
                'id' => 2,
                'nome' => 'PHP',
                'descricao' => '',
                'categoria_id' => 1,
            ],
            2 => [
                'id' => 3,
                'nome' => 'Java',
                'descricao' => '',
                'categoria_id' => 1,
            ],
            3 => [
                'id' => 4,
                'nome' => 'JavaScript',
                'descricao' => '',
                'categoria_id' => 1,
            ],
            4 => [
                'id' => 5,
                'nome' => 'Sistemas Operacionais',
                'descricao' => '',
                'categoria_id' => null,
            ],
            5 => [
                'id' => 6,
                'nome' => 'Windows',
                'descricao' => '',
                'categoria_id' => 5,
            ],
            6 => [
                'id' => 7,
                'nome' => 'iOS',
                'descricao' => '',
                'categoria_id' => 5,
            ],
            7 => [
                'id' => 8,
                'nome' => 'Linux',
                'descricao' => '',
                'categoria_id' => 5,
            ],
            8 => [
                'id' => 9,
                'nome' => 'Ubuntu',
                'descricao' => '',
                'categoria_id' => 8,
            ]
        ];
        DB::table('categorias')->insert($cats);
    }
}
