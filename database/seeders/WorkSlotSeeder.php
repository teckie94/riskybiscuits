<?php

namespace Database\Seeders;

use App\Models\WorkSlot;
use DateTime;
use Illuminate\Database\Seeder;

class WorkSlotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    

    public function run()
    {
        //init startDateTime and endDateTime
        $start_datetime = new DateTime();
        $start_datetime->setDate(2023, 11, 1);
        $start_datetime->setTime(7, 30);

        $end_datetime = new DateTime();
        $end_datetime->setDate(2023, 11, 1);
        $end_datetime->setTime(13, 30);
        // Create Workslot
        $workslot = WorkSlot::create([
            'start_datetime' => $start_datetime,
            'end_datetime'=> $end_datetime,
            'cafe_id' => 1,
            'staff_role_id' => 1,
        ]);
        $workslot = WorkSlot::create([
            'start_datetime' => $start_datetime,
            'end_datetime'=> $end_datetime,
            'cafe_id' => 1,
            'staff_role_id' => 2,
        ]);

        $workslot = WorkSlot::create([
            'start_datetime' => $start_datetime,
            'end_datetime'=> $end_datetime,
            'cafe_id' => 1,
            'staff_role_id' => 3,
        ]);

        $start_datetime->setTime(13,30);
        $end_datetime->setTime(18,30);
        $workslot = WorkSlot::create([
            'start_datetime' => $start_datetime,
            'end_datetime'=> $end_datetime,
            'cafe_id' => 1,
            'staff_role_id' => 1,
        ]);
        $workslot = WorkSlot::create([
            'start_datetime' => $start_datetime,
            'end_datetime'=> $end_datetime,
            'cafe_id' => 1,
            'staff_role_id' => 2,
        ]);
        $workslot = WorkSlot::create([
            'start_datetime' => $start_datetime,
            'end_datetime'=> $end_datetime,
            'cafe_id' => 1,
            'staff_role_id' => 3,
        ]);

        $start_datetime->setTime(18,30);
        $end_datetime->setTime(23,30);
        $workslot = WorkSlot::create([
            'start_datetime' => $start_datetime,
            'end_datetime'=> $end_datetime,
            'cafe_id' => 1,
            'staff_role_id' => 1,
        ]);
        $workslot = WorkSlot::create([
            'start_datetime' => $start_datetime,
            'end_datetime'=> $end_datetime,
            'cafe_id' => 1,
            'staff_role_id' => 2,
        ]);
        $workslot = WorkSlot::create([
            'start_datetime' => $start_datetime,
            'end_datetime'=> $end_datetime,
            'cafe_id' => 1,
            'staff_role_id' => 3,
        ]);

    }
}
