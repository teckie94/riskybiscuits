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
        $workSlot = Workslot::all()->random();
        return [
            'work_slot_id' => $workSlot->id,
            'user_id' => User::query()->where($workSlot->staff_role_id,'=',DB::raw('staff_role_id')),
            'status' => $this->faker->numberBetween(-1,1),
        ];
    }

}
