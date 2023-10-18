<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create Admin User
        $user = User::create([
            'first_name'    => 'Super2',
            'last_name'     => 'Admin',
            'email'         =>  'superadmin@gmail.com',
            'mobile_number' =>  '81818181',
            'password'      =>  Hash::make('111'),
            'role_id'       => 1
        ]);

        $user = User::create([
            'first_name'    => 'Cafe',
            'last_name'     => 'Owner',
            'email'         =>  'owner@gmail.com',
            'mobile_number' =>  '82828282',
            'password'      =>  Hash::make('111'),
            'role_id'       => 2
        ]);

        $user = User::create([
            'first_name'    => 'Cafe',
            'last_name'     => 'Manager',
            'email'         =>  'manager@gmail.com',
            'mobile_number' =>  '83838423',
            'password'      =>  Hash::make('111'),
            'role_id'       => 3
        ]);

        $user = User::create([
            'first_name'    => 'Cafe',
            'last_name'     => 'Staff',
            'email'         =>  'staff@gmail.com',
            'mobile_number' =>  '83358423',
            'password'      =>  Hash::make('111'),
            'role_id'       => 3
        ]);
    }
}
