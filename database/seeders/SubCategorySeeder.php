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
                'category_id' => 1,
                'name_subcategory' => 'Pistas Generales',
                'descr_subcategory' => '<p>Pistas paralelas. Se comparte el retorno de bolos entres dos pistas.</p>',
                'time_init' => '15:00:00',
                'time_finish' => '22:00:00',
                'price_monday' => 105.00,
                'price_tuesday' => 110.00,
                'price_wednesday' => 112.00,
                'price_thursday' => 115.00,
                'price_friday' => 140.00,
                'price_saturday' => 145.00,
                'price_sunday' => 145.00,
                'limit_subcategory' => 5,
                'img_subcategory' => '66eae661a236b.webp',
                'color_subcategory' => 'success',
                'extend_subcategory' => 'Holiday',
                'status_subcategory' => 1,
                'created_at' => '2024-05-22 15:17:36',
                'updated_at' => '2024-06-10 16:19:54',
            ],
            [
                'category_id' => 1,
                'name_subcategory' => 'Pista VIP',
                'descr_subcategory' => '<p>Pista exclusiva y privada, en un box. No se comparte el retorno de bolos con otra pista.</p>',
                'time_init' => '15:00:00',
                'time_finish' => '22:00:00',
                'price_monday' => 160.00,
                'price_tuesday' => 165.00,
                'price_wednesday' => 170.00,
                'price_thursday' => 175.00,
                'price_friday' => 210.00,
                'price_saturday' => 215.00,
                'price_sunday' => 215.00,
                'limit_subcategory' => 5,
                'img_subcategory' => '66eae67123e40.webp',
                'color_subcategory' => 'danger',
                'extend_subcategory' => 'Personal',
                'status_subcategory' => 1,
                'created_at' => '2024-05-22 22:04:21',
                'updated_at' => '2024-06-10 16:20:07',
            ],
            [
                'category_id' => 1,
                'name_subcategory' => 'Pista Easy Duo VIP',
                'descr_subcategory' => '<p>Dos pistas juntas exclusivas y privadas. Comparten el retorno de bolos entre ellas.</p>',
                'time_init' => '15:00:00',
                'time_finish' => '22:00:00',
                'price_monday' => 260.00,
                'price_tuesday' => 265.00,
                'price_wednesday' => 270.00,
                'price_thursday' => 275.00,
                'price_friday' => 330.00,
                'price_saturday' => 335.00,
                'price_sunday' => 335.00,
                'limit_subcategory' => 10,
                'img_subcategory' => '66eae6778a71a.webp',
                'color_subcategory' => 'warning',
                'extend_subcategory' => 'Family',
                'status_subcategory' => 1,
                'created_at' => '2024-05-22 22:04:32',
                'updated_at' => '2024-06-10 16:20:13',
            ],
            [
                'category_id' => 2,
                'name_subcategory' => 'Billar',
                'descr_subcategory' => '<p>Seis mesas de billar profesionales.</p>',
                'time_init' => '15:00:00',
                'time_finish' => '22:00:00',
                'price_monday' => 40.00,
                'price_tuesday' => 40.00,
                'price_wednesday' => 40.00,
                'price_thursday' => 40.00,
                'price_friday' => 40.00,
                'price_saturday' => 55.00,
                'price_sunday' => 55.00,
                'limit_subcategory' => 3,
                'img_subcategory' => '66eae67caf2ec.webp',
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
