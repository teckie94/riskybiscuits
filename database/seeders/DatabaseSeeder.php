<?php

namespace Database\Seeders;


use App\Models\User;
use App\Models\StaffRoleBid;
use App\Models\StaffRoles;
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
            StaffRoleSeeder::class,
            AdminSeeder::class,
            RoleSeeder::class,
            PermissionSeeder::class,
            WorkSlotSeeder::class,
            StaffRoleBidSeeder::class,
            WorkSlotBidSeeder::class,
        ]);

        // $user = User::factory(100)
        //     ->has(StaffRoleBid::factory()->count(1))
        //     ->has(WorkSlotBid::factory()->count(3))
        //     ->create();
        //$users = User::factory(100)->create();
        // $staffrolebids = StaffRoleBid::factory(100)->create([
        //     'staff_role_id' => $staffroles->id,
        //     'user_id' => $users->id
        // ]);
        // $workslotbids = WorkSlotBid::factory(100)->create([
        //     'work_slot_id' => $workslots->id,
        //     'user_id' => $users->id
        // ]);
        $staffrolebids = StaffRoleBid::factory(100)
                        ->create();
        $workslotbids = WorkSlotBid::factory(100)->create();

    }
}
