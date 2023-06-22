<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       

        $user = User::create([
            'name' => 'SuperAdmin',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('11111111'),
        ]);
        $user->assignRole('SuperAdmin');


        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('11111111'),
        ]);
        $user->assignRole(['Manager', 'Moderator']);


        $user = User::create([
            'name' => 'Manager',
            'email' => 'manager@gmail.com',
            'password' => Hash::make('11111111'),
        ]);
        $user->assignRole('Manager');

        
        $user = User::create([
            'name' => 'Moderator',
            'email' => 'moderator@gmail.com',
            'password' => Hash::make('11111111'),
        ]);
        $user->assignRole('Moderator');


        $user = User::create([
            'name' => 'Guest',
            'email' => 'guest@gmail.com',
            'password' => Hash::make('11111111'),
        ]);
        $user->assignRole('Guest');

    }
}
