<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'Reportes']);
        $role3 = Role::create(['name' => 'Controller']);
        $role4 = Role::create(['name' => 'Cajas']);

        Permission::create(['name' => 'admin.categories.index'])->syncRoles([$role1, $role3]);
        Permission::create(['name' => 'admin.categories.create'])->syncRoles([$role1, $role3]);
        Permission::create(['name' => 'admin.categories.edit'])->syncRoles([$role1, $role3]);
        Permission::create(['name' => 'admin.categories.destroy'])->syncRoles([$role1, $role3]);
    }
}
