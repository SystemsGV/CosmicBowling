<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Valenzuela Estrada Marlon Emerson',
            'username' => 'admin',
            'password' => Hash::make('admin2021'),
            'email' => 'jsistemasgv@gmail.com'
        ])->assignRole('Admin');

    }
}
