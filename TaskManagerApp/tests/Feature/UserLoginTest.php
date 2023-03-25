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
    public function check_token_for_user()
    {
        $response = $this->get('/auth/register',[
            "username"=> "newUser1",
            "password"=> "123H@123"
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                "token" => true
            ]);
    }
}
