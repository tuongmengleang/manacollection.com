<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // Reset cached roles and permissions
      app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

      // create permissions
      Permission::create(['name' => 'user-create', 'display_name' => 'User Create', 'guard_name' => 'admin']);
      Permission::create(['name' => 'user-edit', 'display_name' => 'User Edit', 'guard_name' => 'admin']);
      Permission::create(['name' => 'user-delete', 'display_name' => 'User Delete', 'guard_name' => 'admin']);
      Permission::create(['name' => 'user-permissions', 'display_name' => 'User Permissions', 'guard_name' => 'admin']);

      // create roles and assign created permissions
      // User, Admin, Developer Roles
      Role::create(['name' => 'user', 'display_name' => 'User', 'guard_name' => 'admin'])
        ->givePermissionTo(['user-create', 'user-edit']);

      // Admin Role
      Role::create(['name' => 'admin', 'display_name' => 'Admin', 'guard_name' => 'admin'])
        ->givePermissionTo(Permission::all());
    }
}
