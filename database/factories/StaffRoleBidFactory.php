<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;
class StaffRoleBidFactory extends Factory
{

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'staff_role_id' =>function (array $attributes){
                return User::find($attributes['user_id'])->staff_role_id;
            },
            'status' => 1,
        ];
    }

}
