<?php

namespace Database\Seeders;

use App\Models\WorkSlot;
use Carbon\Carbon;
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
        $start_date = Carbon::createFromDate('2023', '11', '1');
        $startTime = Carbon::createFromTime('7', '30', '0');
        $endTime = Carbon::createFromTime('13', '30', '0');
        $dayShiftInterval=0;
        $timeShiftInterval=0;
        $shiftName = 'Morning Shift';
        
        for($i =0;$i<5;$i++){

            for($staffroleid=1;$staffroleid<=3;$staffroleid++){
                

            
                if($dayShiftInterval%3 == 0 && $i !=0){
                    $start_date->addDay();
                    $startTime->addHours(9);
                    $endTime->addHours(9);
                    $shiftName='Morning Shift';
                }
                
                if($timeShiftInterval % 3== 0 && $i != 0){
                    $startTime->addHours(6);
                    $endTime->addHours(6);
                    $shiftName='Morning Shift';
                }
                elseif($timeShiftInterval%3 == 1 && $i != 0){
                    $startTime->addHours(6);
                    $endTime->addHours(6);
                    $shiftName='Noon Shift';
                }
                elseif($timeShiftInterval%3 == 2 && $i != 0){
                    $startTime->addHours(3);
                    $endTime->addHours(3);
                    $shiftName='Night Shift';
                }
                $workslot = WorkSlot::create([
                    'time_slot_name' => $shiftName,
                    'start_date' => $start_date,
                    'end_date' =>$start_date,
                    'start_time' => $startTime,
                    'end_time' =>$endTime,
                    'staff_role_id' => $staffroleid,
                    'quantity' => rand(1,5),
                ]);
                $dayShiftInterval++;
                $timeShiftInterval++;
            }
        }

        
        // // Create Workslot
        // $workslot = WorkSlot::create([
        //     'time_slot_name' => 'AM Shift',
        //     'start_date' => $start_date,
        //     'end_date' =>$start_date,
        //     'start_time' => $startTime,
        //     'end_time' =>$endTime,
        //     'staff_role_id' => 1,
        //     'quantity' => 1,
        // ]);
        // $workslot = WorkSlot::create([
        //     'time_slot_name' => 'AM Shift',
        //     'start_date' => $start_date,
        //     'end_date' =>$start_date,
        //     'start_time' => $startTime,
        //     'end_time' =>$endTime,
        //     'staff_role_id' => 2,
        //     'quantity' => 1,
        // ]);

        // $workslot = WorkSlot::create([
        //     'time_slot_name' => 'AM Shift',
        //     'start_date' => $start_date,
        //     'end_date' =>$start_date,
        //     'start_time' => $startTime,
        //     'end_time' =>$endTime,
        //     'staff_role_id' => 3,
        //     'quantity' => 1,
        // ]);
    }
}
