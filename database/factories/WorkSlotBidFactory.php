<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\WorkSlot;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class WorkSlotBidFactory extends Factory
{

    public function definition()
    {
        $user=User::all()->where('staff_role_id','!=',null)->random();
        $workslotId = Workslot::query()
        ->where('staff_role_id',$user->staff_role_id)
        ->first();
        return [
            'user_id' => $user->id,
            'work_slot_id' => $workslotId,
            'status' =>$this->faker->numberBetween(-1,3),
        ];
    }

}
