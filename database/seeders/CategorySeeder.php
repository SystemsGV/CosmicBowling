<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'id_category' => 1,
                'name_category' => 'Pistas',
                'descr_category' => '<p>Ninguna descripcion</p>',
                'img_category' => '664dfee7f1f75.jpg',
                'status_category' => 1,
                'created_at' => '2024-05-21 22:17:55',
                'updated_at' => '2024-05-22 22:03:48',
            ],
            [
                'id_category' => 2,
                'name_category' => 'Billar',
                'descr_category' => '<p><br></p>',
                'img_category' => NULL,
                'status_category' => 1,
                'created_at' => '2024-05-22 22:03:43',
                'updated_at' => '2024-05-22 22:03:43',
            ],
        ];

        // Insertar los datos en la tabla categories
        DB::table('categories')->insert($categories);
    }
}
