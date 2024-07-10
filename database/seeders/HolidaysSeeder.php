<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HolidaysSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $holidays = [
            [
                'name_holiday' => 'Día de la Independencia',
                'date_holiday' => '2024-07-28'
            ]
        ];
        DB::table('holidays')->insert($holidays);
    }
}
