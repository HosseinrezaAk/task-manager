<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserLoginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_register_user()
    {
        $response = $this->postJson('/auth/register',[
            "username"=> "newUser3",
            "password"=> "123H@1234"
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                "token" => true
            ]);
    }


    public function test_login_user(){
        $response = $this->postJson("/auth/login",[
            "username"=> "newUser2",
            "password"=> "123H@1234"
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                "access_token"=> true
            ]);
    }
}
