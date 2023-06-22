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
     */
    public function run()
    {
        $admin = Role::findOrCreate('SuperAdmin');
        $manager = Role::findOrCreate('Manager');
        $moderator = Role::findOrCreate('Moderator');
        $guest = Role::findOrCreate('Guest');

        foreach (Permission::all() as $permission) {
            $admin->givePermissionTo($permission->name);

            if (str_ends_with($permission->name, ':view')) {
                $moderator->givePermissionTo($permission->name);
                $manager->givePermissionTo($permission->name);
                $guest->givePermissionTo($permission->name);
            }
            
            if (str_ends_with($permission->name, ':add')) {
                $manager->givePermissionTo($permission->name);
            }

            if (str_ends_with($permission->name, ':update')) {
                $moderator->givePermissionTo($permission->name);
            }
        }
    }
}
