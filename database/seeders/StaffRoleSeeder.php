<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StaffRole;

class StaffRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StaffRole::create([
            'name' => 'Chef',
            'role_id' => '4'
        ]);

        StaffRole::create([
            'name' => 'Waiter',
            'role_id' => '4'
        ]);

        StaffRole::create([
            'name' => 'Cashier',
            'role_id' => '4'
        ]);

    }
}
