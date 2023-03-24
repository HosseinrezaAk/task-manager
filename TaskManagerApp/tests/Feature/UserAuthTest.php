<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserAuthTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_register_user()
    {
        $response = $this->postJson('/auth/register',[
            "username"=> "newUser6",
            "password"=> "123H@1234"
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                "token" => true
            ]);
    }


    public function test_login_user(){

        $user = User::factory()->create([
            'username' => 'newUser5',
            'password' => bcrypt('password'),
        ]);
        $response = $this->postJson("/auth/login",[
            "username"=> "newUser5",
            "password"=> "password"
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                "access_token"=> true
            ]);
        $this->assertAuthenticatedAs($user);
    }
}
