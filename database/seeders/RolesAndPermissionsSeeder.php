<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesAndPermissionsSeeder extends Seeder
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

        $permissions = [
            'pos_access',
            'products_access',
            'products_create',
            'products_edit',
            'products_delete',
            'inventory_access',
            'inventory_edit',
            'users_access',
            'users_create',
            'users_edit',
            'users_delete',
            'configurations_access',
            'company_edit',
            'ticket_edit',
        ];

        $sales = [
            'pos_access',
            'products_access',
            'products_create',
            'products_edit',
            'inventory_access',
            'inventory_edit',
        ];


        foreach ($permissions as $permission) {
            // create permissions
            Permission::create(['name' => $permission]);
        }

        // Create super admin ang dive permission
        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(Permission::all());


        // Create sales role ang dive permission
        $role = Role::create(['name' => 'ventas']);
        $role->givePermissionTo($sales);
    }
}
