<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'id_product' => 1,
                'category_id' => 1,
                'subcategory_id' => 1,
                'name_product' => 'Pista N1',
                'descr_product' => '<p>Funciones: </p><ol><li>1</li><li>2</li><li>3</li><li>4</li><li>45</li></ol>',
                'img_product' => '6650a2c6a4869.jpg',
                'price_productlj' => 100.00,
                'price_productfds' => 150.00,
                'stock_product' => 1,
                'status_product' => 1,
                'guests_product' => 5,
                'icon_product' => 'mdi mdi-bowling',
                'created_at' => '2024-05-23 16:58:16',
                'updated_at' => '2024-05-28 14:39:02',
            ],
            [
                'id_product' => 2,
                'category_id' => 1,
                'subcategory_id' => 1,
                'name_product' => 'Pista N2',
                'descr_product' => '<p>Nueva pista de diversion bla bla bla...</p>',
                'img_product' => NULL,
                'price_productlj' => 100.00,
                'price_productfds' => 0.00,
                'stock_product' => 1,
                'status_product' => 1,
                'guests_product' => 5,
                'icon_product' => 'mdi mdi-bowling',
                'created_at' => '2024-05-23 21:53:23',
                'updated_at' => '2024-05-24 14:54:17',
            ],
            [
                'id_product' => 3,
                'category_id' => 1,
                'subcategory_id' => 1,
                'name_product' => 'Pista N3',
                'descr_product' => '<p>Nueva psta</p>',
                'img_product' => NULL,
                'price_productlj' => 200.00,
                'price_productfds' => 0.00,
                'stock_product' => 1,
                'status_product' => 1,
                'guests_product' => 5,
                'icon_product' => 'mdi mdi-bowling',
                'created_at' => '2024-05-23 21:54:15',
                'updated_at' => '2024-05-24 14:54:21',
            ],
            [
                'id_product' => 4,
                'category_id' => 1,
                'subcategory_id' => 1,
                'name_product' => 'Pista N4',
                'descr_product' => '<p>Nueva psta</p>',
                'img_product' => NULL,
                'price_productlj' => 200.00,
                'price_productfds' => 0.00,
                'stock_product' => 1,
                'status_product' => 1,
                'guests_product' => 5,
                'icon_product' => 'mdi mdi-bowling',
                'created_at' => '2024-05-23 21:54:31',
                'updated_at' => '2024-05-24 14:54:27',
            ],
            [
                'id_product' => 5,
                'category_id' => 1,
                'subcategory_id' => 1,
                'name_product' => 'Pista N5',
                'descr_product' => '<p>Pista general</p>',
                'img_product' => NULL,
                'price_productlj' => 100.00,
                'price_productfds' => 150.00,
                'stock_product' => 1,
                'status_product' => 1,
                'guests_product' => 5,
                'icon_product' => 'mdi mdi-bowling',
                'created_at' => '2024-05-24 14:54:11',
                'updated_at' => '2024-05-28 14:39:21',
            ],
            [
                'id_product' => 6,
                'category_id' => 1,
                'subcategory_id' => 1,
                'name_product' => 'Pista N6',
                'descr_product' => '<p>Pista número 6</p>',
                'img_product' => NULL,
                'price_productlj' => 100.00,
                'price_productfds' => 0.00,
                'stock_product' => 1,
                'status_product' => 1,
                'guests_product' => 5,
                'icon_product' => 'mdi mdi-bowling',
                'created_at' => '2024-05-24 14:55:15',
                'updated_at' => '2024-05-24 14:55:15',
            ],
            [
                'id_product' => 7,
                'category_id' => 1,
                'subcategory_id' => 1,
                'name_product' => 'Pista N7',
                'descr_product' => '<p><br></p>',
                'img_product' => NULL,
                'price_productlj' => 100.00,
                'price_productfds' => 0.00,
                'stock_product' => 1,
                'status_product' => 1,
                'guests_product' => 5,
                'icon_product' => 'mdi mdi-bowling',
                'created_at' => '2024-05-24 14:55:31',
                'updated_at' => '2024-05-24 14:55:31',
            ],
            [
                'id_product' => 8,
                'category_id' => 1,
                'subcategory_id' => 1,
                'name_product' => 'Pista N8',
                'descr_product' => '<p><br></p>',
                'img_product' => NULL,
                'price_productlj' => 100.00,
                'price_productfds' => 0.00,
                'stock_product' => 1,
                'status_product' => 1,
                'guests_product' => 5,
                'icon_product' => 'mdi mdi-bowling',
                'created_at' => '2024-05-24 14:55:46',
                'updated_at' => '2024-05-24 14:55:46',
            ],
            [
                'id_product' => 9,
                'category_id' => 1,
                'subcategory_id' => 1,
                'name_product' => 'Pista N9',
                'descr_product' => '<p><br></p>',
                'img_product' => NULL,
                'price_productlj' => 100.00,
                'price_productfds' => 0.00,
                'stock_product' => 1,
                'status_product' => 1,
                'guests_product' => 5,
                'icon_product' => 'mdi mdi-bowling',
                'created_at' => '2024-05-24 14:56:40',
                'updated_at' => '2024-05-24 14:56:40',
            ],
            [
                'id_product' => 10,
                'category_id' => 1,
                'subcategory_id' => 1,
                'name_product' => 'Pista N10',
                'descr_product' => '<p><br></p>',
                'img_product' => NULL,
                'price_productlj' => 100.00,
                'price_productfds' => 0.00,
                'stock_product' => 1,
                'status_product' => 1,
                'guests_product' => 5,
                'icon_product' => 'mdi mdi-bowling',
                'created_at' => '2024-05-24 14:57:33',
                'updated_at' => '2024-05-24 14:57:33',
            ],
            [
                'id_product' => 11,
                'category_id' => 1,
                'subcategory_id' => 1,
                'name_product' => 'Pista N11',
                'descr_product' => '<p><br></p>',
                'img_product' => NULL,
                'price_productlj' => 100.00,
                'price_productfds' => 0.00,
                'stock_product' => 1,
                'status_product' => 1,
                'guests_product' => 5,
                'icon_product' => 'mdi mdi-bowling',
                'created_at' => '2024-05-24 14:58:13',
                'updated_at' => '2024-05-24 14:58:13',
            ],
            [
                'id_product' => 12,
                'category_id' => 1,
                'subcategory_id' => 1,
                'name_product' => 'Pista N12',
                'descr_product' => '<p><br></p>',
                'img_product' => NULL,
                'price_productlj' => 100.00,
                'price_productfds' => 0.00,
                'stock_product' => 1,
                'status_product' => 1,
                'guests_product' => 5,
                'icon_product' => 'mdi mdi-bowling',
                'created_at' => '2024-05-24 14:58:34',
                'updated_at' => '2024-05-24 14:58:34',
            ],
            [
                'id_product' => 13,
                'category_id' => 1,
                'subcategory_id' => 1,
                'name_product' => 'Pista N13',
                'descr_product' => '<p><br></p>',
                'img_product' => NULL,
                'price_productlj' => 100.00,
                'price_productfds' => 0.00,
                'stock_product' => 1,
                'status_product' => 1,
                'guests_product' => 5,
                'icon_product' => 'mdi mdi-bowling',
                'created_at' => '2024-05-24 14:58:50',
                'updated_at' => '2024-05-24 15:03:52',
            ],
            [
                'id_product' => 14,
                'category_id' => 1,
                'subcategory_id' => 1,
                'name_product' => 'Pista N14',
                'descr_product' => '<p><br></p>',
                'img_product' => NULL,
                'price_productlj' => 100.00,
                'price_productfds' => 0.00,
                'stock_product' => 1,
                'status_product' => 1,
                'guests_product' => 5,
                'icon_product' => 'mdi mdi-bowling',
                'created_at' => '2024-05-24 14:59:04',
                'updated_at' => '2024-05-24 15:03:59',
            ],
            [
                'id_product' => 15,
                'category_id' => 1,
                'subcategory_id' => 1,
                'name_product' => 'Pista N15',
                'descr_product' => '<p><br></p>',
                'img_product' => NULL,
                'price_productlj' => 100.00,
                'price_productfds' => 0.00,
                'stock_product' => 1,
                'status_product' => 1,
                'guests_product' => 5,
                'icon_product' => 'mdi mdi-bowling',
                'created_at' => '2024-05-24 14:59:31',
                'updated_at' => '2024-05-24 15:04:06',
            ],
            [
                'id_product' => 16,
                'category_id' => 1,
                'subcategory_id' => 1,
                'name_product' => 'Pista N16',
                'descr_product' => '<p><br></p>',
                'img_product' => NULL,
                'price_productlj' => 100.00,
                'price_productfds' => 0.00,
                'stock_product' => 1,
                'status_product' => 1,
                'guests_product' => 5,
                'icon_product' => 'mdi mdi-bowling',
                'created_at' => '2024-05-24 14:59:50',
                'updated_at' => '2024-05-24 15:04:13',
            ],
            [
                'id_product' => 17,
                'category_id' => 1,
                'subcategory_id' => 1,
                'name_product' => 'Pista N17',
                'descr_product' => '<p><br></p>',
                'img_product' => NULL,
                'price_productlj' => 100.00,
                'price_productfds' => 0.00,
                'stock_product' => 1,
                'status_product' => 1,
                'guests_product' => 5,
                'icon_product' => 'mdi mdi-bowling',
                'created_at' => '2024-05-24 15:00:07',
                'updated_at' => '2024-05-24 15:04:20',
            ],
            [
                'id_product' => 18,
                'category_id' => 1,
                'subcategory_id' => 1,
                'name_product' => 'Pista N18',
                'descr_product' => '<p><br></p>',
                'img_product' => NULL,
                'price_productlj' => 100.00,
                'price_productfds' => 0.00,
                'stock_product' => 1,
                'status_product' => 1,
                'guests_product' => 5,
                'icon_product' => 'mdi mdi-bowling',
                'created_at' => '2024-05-24 15:00:23',
                'updated_at' => '2024-05-24 15:04:25',
            ],
            [
                'id_product' => 19,
                'category_id' => 1,
                'subcategory_id' => 1,
                'name_product' => 'Pista N19',
                'descr_product' => '<p><br></p>',
                'img_product' => NULL,
                'price_productlj' => 100.00,
                'price_productfds' => 0.00,
                'stock_product' => 1,
                'status_product' => 1,
                'guests_product' => 5,
                'icon_product' => 'mdi mdi-bowling',
                'created_at' => '2024-05-24 15:00:37',
                'updated_at' => '2024-05-24 15:04:36',
            ],
            [
                'id_product' => 20,
                'category_id' => 1,
                'subcategory_id' => 1,
                'name_product' => 'Pista N20',
                'descr_product' => '<p><br></p>',
                'img_product' => NULL,
                'price_productlj' => 100.00,
                'price_productfds' => 0.00,
                'stock_product' => 1,
                'status_product' => 1,
                'guests_product' => 5,
                'icon_product' => 'mdi mdi-bowling',
                'created_at' => '2024-05-24 15:03:08',
                'updated_at' => '2024-05-24 15:04:41',
            ],
            [
                'id_product' => 21,
                'category_id' => 2,
                'subcategory_id' =>4,
                'name_product' => 'Billar N1',
                'descr_product' => '<p><br></p>',
                'img_product' => NULL,
                'price_productlj' => 100.00,
                'price_productfds' => 0.00,
                'stock_product' => 1,
                'status_product' => 1,
                'guests_product' => 3,
                'icon_product' => 'mdi mdi-billiards',
                'created_at' => '2024-05-24 15:03:38',
                'updated_at' => '2024-05-24 15:04:55',
            ],
            [
                'id_product' => 22,
                'category_id' => 2,
                'subcategory_id' =>4,
                'name_product' => 'Billar N2',
                'descr_product' => '<p><br></p>',
                'img_product' => NULL,
                'price_productlj' => 100.00,
                'price_productfds' => 0.00,
                'stock_product' => 1,
                'status_product' => 1,
                'guests_product' => 3,
                'icon_product' => 'mdi mdi-billiards',
                'created_at' => '2024-05-24 15:05:09',
                'updated_at' => '2024-05-24 15:05:17',
            ],
            [
                'id_product' => 23,
                'category_id' => 2,
                'subcategory_id' =>4,
                'name_product' => 'Billar N3',
                'descr_product' => '<p><br></p>',
                'img_product' => NULL,
                'price_productlj' => 100.00,
                'price_productfds' => 0.00,
                'stock_product' => 1,
                'status_product' => 1,
                'guests_product' => 3,
                'icon_product' => 'mdi mdi-billiards',
                'created_at' => '2024-05-24 15:08:03',
                'updated_at' => '2024-05-24 15:08:03',
            ],
            [
                'id_product' => 24,
                'category_id' => 2,
                'subcategory_id' =>4,
                'name_product' => 'Billar N4',
                'descr_product' => '<p><br></p>',
                'img_product' => NULL,
                'price_productlj' => 100.00,
                'price_productfds' => 0.00,
                'stock_product' => 1,
                'status_product' => 1,
                'guests_product' => 3,
                'icon_product' => 'mdi mdi-billiards',
                'created_at' => '2024-05-24 15:08:20',
                'updated_at' => '2024-05-24 15:08:20',
            ],
            [
                'id_product' => 25,
                'category_id' => 1,
                'subcategory_id' => 2,
                'name_product' => 'Pista VIP 1',
                'descr_product' => '<p><br></p>',
                'img_product' => NULL,
                'price_productlj' => 100.00,
                'price_productfds' => 0.00,
                'stock_product' => 1,
                'status_product' => 1,
                'guests_product' => 3,
                'icon_product' => 'mdi mdi-bowling',
                'created_at' => '2024-05-24 15:08:47',
                'updated_at' => '2024-05-24 15:08:47',
            ],
            [
                'id_product' => 26,
                'category_id' => 1,
                'subcategory_id' => 3,
                'name_product' => 'Pista Easy Duo VIP',
                'descr_product' => '<p><br></p>',
                'img_product' => NULL,
                'price_productlj' => 100.00,
                'price_productfds' => 0.00,
                'stock_product' => 1,
                'status_product' => 1,
                'guests_product' => 10,
                'icon_product' => 'mdi mdi-bowling',
                'created_at' => '2024-05-24 15:09:19',
                'updated_at' => '2024-05-24 15:09:40',
            ]
        ];

        DB::table('products')->insert($products);
    }
}
