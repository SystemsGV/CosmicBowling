<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subcategories = [
            [
                'id_subcategory' => 1,
                'category_id' => 1,
                'name_subcategory' => 'Pistas General',
                'descr_subcategory' => '<p>Ninguna Descripcion</p>',
                'time_init' => '15:00:00',
                'time_finish' => '22:00:00',
                'price_sublj' => 120.00,
                'price_subfds' => 150.00,
                'img_subcategory' => '66608dca4fddf.png',
                'color_subcategory' => 'success',
                'extend_subcategory' => 'Holiday',
                'status_subcategory' => 1,
                'created_at' => '2024-05-22 15:17:36',
                'updated_at' => '2024-06-10 16:19:54',
            ],
            [
                'id_subcategory' => 3,
                'category_id' => 1,
                'name_subcategory' => 'Pistas VIP',
                'descr_subcategory' => '<p><br></p>',
                'time_init' => '15:00:00',
                'time_finish' => '22:00:00',
                'price_sublj' => 180.00,
                'price_subfds' => 220.00,
                'img_subcategory' => '66608e3d65066.jpg',
                'color_subcategory' => 'danger',
                'extend_subcategory' => 'Personal',
                'status_subcategory' => 1,
                'created_at' => '2024-05-22 22:04:21',
                'updated_at' => '2024-06-10 16:20:07',
            ],
            [
                'id_subcategory' => 4,
                'category_id' => 1,
                'name_subcategory' => 'Pistas Duo VIP',
                'descr_subcategory' => '<p><br></p>',
                'time_init' => '15:00:00',
                'time_finish' => '22:00:00',
                'price_sublj' => 280.00,
                'price_subfds' => 340.00,
                'img_subcategory' => '66608e6eefdab.png',
                'color_subcategory' => 'warning',
                'extend_subcategory' => 'Family',
                'status_subcategory' => 1,
                'created_at' => '2024-05-22 22:04:32',
                'updated_at' => '2024-06-10 16:20:13',
            ],
            [
                'id_subcategory' => 5,
                'category_id' => 2,
                'name_subcategory' => 'Billares',
                'descr_subcategory' => '<p><br></p>',
                'time_init' => '15:00:00',
                'time_finish' => '22:00:00',
                'price_sublj' => 40.00,
                'price_subfds' => 55.00,
                'img_subcategory' => '66608e5148a3c.png',
                'color_subcategory' => 'info',
                'extend_subcategory' => 'ETC',
                'status_subcategory' => 1,
                'created_at' => '2024-05-22 22:04:59',
                'updated_at' => '2024-06-10 16:20:17',
            ],
        ];

        // Insertar los datos en la tabla subcategories
        DB::table('subcategories')->insert($subcategories);
    }
}
