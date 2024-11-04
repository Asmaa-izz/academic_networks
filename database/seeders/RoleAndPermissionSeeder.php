<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
        Role::firstOrCreate(['name' => 'doctor']);
        Role::firstOrCreate(['name' => 'student']);

        // User
        Permission::firstOrCreate(['name' => 'access_user']);
        Permission::firstOrCreate(['name' => 'create_user']);
        Permission::firstOrCreate(['name' => 'update_user']);
        Permission::firstOrCreate(['name' => 'delete_user']);

        // Group
        Permission::firstOrCreate(['name' => 'access_group']);
        Permission::firstOrCreate(['name' => 'create_group']);
        Permission::firstOrCreate(['name' => 'update_group']);
        Permission::firstOrCreate(['name' => 'delete_group']);

        // Post
        Permission::firstOrCreate(['name' => 'access_post']);
        Permission::firstOrCreate(['name' => 'create_post']);
        Permission::firstOrCreate(['name' => 'update_post']);
        Permission::firstOrCreate(['name' => 'delete_post']);

        // Comment
        Permission::firstOrCreate(['name' => 'access_comment']);
        Permission::firstOrCreate(['name' => 'create_comment']);
        Permission::firstOrCreate(['name' => 'update_comment']);
        Permission::firstOrCreate(['name' => 'delete_comment']);

        //roles
        Permission::firstOrCreate(['name' => 'access_role']);
        Permission::firstOrCreate(['name' => 'create_role']);
        Permission::firstOrCreate(['name' => 'update_role']);
        Permission::firstOrCreate(['name' => 'delete_role']);

        //permissions
        Permission::firstOrCreate(['name' => 'access_permission']);
        Permission::firstOrCreate(['name' => 'create_permission']);
        Permission::firstOrCreate(['name' => 'update_permission']);
        Permission::firstOrCreate(['name' => 'delete_permission']);


        $doctor = Role::where('name', '=', 'doctor')->first();
        $doctor->syncPermissions([
            'access_user', 'create_user', 'update_user', 'delete_user',
            'access_group', 'create_group', 'update_group', 'delete_group',
            'access_post', 'create_post', 'update_post', 'delete_post',
            'access_comment', 'create_comment', 'update_comment', 'delete_comment',
            'access_role', 'create_role', 'update_role', 'delete_role',
            'access_permission', 'create_permission', 'update_permission', 'delete_permission',
        ]);

        $student = Role::where('name', '=', 'student')->first();
        $student->syncPermissions([]);

    }
}
