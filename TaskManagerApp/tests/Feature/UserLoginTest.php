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
    public function test_token_for_user()
    {
        $response = $this->postJson('http://127.0.0.1:8000/auth/register',[
            "username"=> "newUser1",
            "password"=> "123H@1234"
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                "token" => true
            ]);
    }
}
