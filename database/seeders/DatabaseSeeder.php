<?php

namespace Database\Seeders;

use App\Models\Admin\Holidays;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       $this->call(RoleSeeder::class);
       $this->call(UserSeeder::class);
       $this->call(CategorySeeder::class);
       $this->call(SubCategorySeeder::class);
       $this->call(ProductSeeder::class);
       $this->call(HolidaysSeeder::class);
       $this->call(TypeDocSeeder::class);

    }
}
