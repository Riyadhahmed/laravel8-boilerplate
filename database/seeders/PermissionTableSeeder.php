<?php


use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Permission;


class PermissionTableSeeder extends Seeder

{

    /**
     * Run the database seeds.
     * @return void
     */

    public function run()

    {

        $permissions = [
            'role-view', 'role-create', 'role-edit', 'role-delete',
            'permission-view', 'permission-create', 'permission-edit', 'permission-delete',
            'user-view', 'user-create', 'user-edit', 'user-delete'
        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'admin']);
        }

    }

}