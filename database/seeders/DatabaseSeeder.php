<?php

namespace Database\Seeders;


use App\Models\User;
use App\Models\StaffRoleBid;
use App\Models\WorkSlot;
use App\Models\WorkSlotBid;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        $this->call([
            AdminSeeder::class,
            RoleSeeder::class,
            PermissionSeeder::class,
            StaffRoleSeeder::class,
            WorkSlotSeeder::class,
            StaffRoleBidSeeder::class,
            WorkSlotBidSeeder::class,
        ]);

        $user = User::factory(100)
            ->has(StaffRoleBid::factory()->count(1))
            ->has(WorkSlotBid::factory()->count(3))
            ->create();

    }
}
