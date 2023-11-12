<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class StaffRoleBidFactory extends Factory
{

    public function definition()
    {
        return [
            'staff_role_id' =>$this->faker->numberBetween(1,3),
            'user_id' => $this->faker->numberBetween(7,106),
            'status' => 0,
        ];
    }

}
