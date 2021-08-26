<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('permissions')->truncate();
        DB::table('role_has_permissions')->truncate();
        $admin = Role::where('name', 'Admin')->first();
        $permissions = [
            'user-list',
            'user-create',
            'user-edit',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'view-profile',
            'save-profile',
            'add-option'

        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $admin_permissions = Permission::select('id')->get();
        $admin->syncPermissions($admin_permissions->toArray());

    }
}
