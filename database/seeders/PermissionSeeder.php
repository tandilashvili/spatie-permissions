<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{

    private $permissions = [


        'role:view',
        'role:add',
        'role:update',
        'role:delete',

        'user:view',
        'user:add',
        'user:update',
        'user:delete',

        'permission:view',
        'permission:add',
        'permission:update',
        'permission:delete',
    

    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        foreach($this->permissions as $permission)
        {
            Permission::create(['name' => $permission]);
        }
    }
}
