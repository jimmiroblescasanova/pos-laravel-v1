<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NewRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'roles_access',
            'roles_create',
            'roles_edit',
            'roles_delete',
            'groups_access',
            'groups_create',
            'groups_delete',
            'sales_access',
            'sales_share',
            'sales_cancel',
        ];

        foreach ($permissions as $permission) {
            // create permissions
            Permission::create(['name' => $permission]);
        }

        // Create super admin ang dive permission
        $role = Role::findByName('admin');
        $role->givePermissionTo(Permission::all());

    }
}
