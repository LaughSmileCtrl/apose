<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'modules.view']);
        Permission::create(['name' => 'modules.create']);
        Permission::create(['name' => 'modules.edit']);
        Permission::create(['name' => 'modules.delete']);
        Permission::create(['name' => 'modules.*']);
        Permission::create(['name' => 'tasks.view']);
        Permission::create(['name' => 'tasks.create']);
        Permission::create(['name' => 'tasks.edit']);
        Permission::create(['name' => 'tasks.delete']);
        Permission::create(['name' => 'tasks.*']);

        Role::create(['name' => 'student'])->givePermissionTo('modules.view');
        Role::create(['name' => 'teacher'])->givePermissionTo('modules.*','tasks.*');
        // Role::create(['name' => 'super-admin'])->givePermissionTo('*');
    }
}
