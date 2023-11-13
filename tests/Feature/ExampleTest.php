<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserTest extends TestCase
{
    public function test_login_redirect_to_dashboard_successfully() {
       User::factory()->create([
        'first_name'    => 'Super',
        'last_name'     => 'Admin2',
        'email'         =>  'superadmin2@gmail.com',
        'mobile_number' =>  '81818181',
        'password'      =>  Hash::make('password'),
        'role_id'       => 1
       ]);

       $response = $this->post('/login',[
        'email'=> 'superadmin2@gmail.com',
        'password' => 'password'
       ]);

       $response->assertStatus(302);
       $response->assertRedirect('/home');
    }
}
