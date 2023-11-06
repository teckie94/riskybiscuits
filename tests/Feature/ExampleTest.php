<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
   public function test_example()
    {

        /* $user = factory(User::class)->create(); */
        $user = User::factory()->create();

        $response = $this->actingAs($user)
                         ->get('/');

        $response->assertStatus(200);
    }
}
