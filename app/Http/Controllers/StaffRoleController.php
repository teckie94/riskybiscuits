<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function createRole()
    {
        // Create a new staff role
        // You can create more roles as needed
        Role::create(['name' => 'Chef']);
        Role::create(['name' => 'Waiter']);
        Role::create(['name' => 'Cashier']);
        

        return "Staff roles created successfully!";
    }
}
