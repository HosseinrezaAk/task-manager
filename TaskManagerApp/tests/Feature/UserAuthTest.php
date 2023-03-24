<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserAuthTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
//    public function test_register_user()
//    {
//        $response = $this->postJson('/auth/register',[
//            "username"=> "newUser6",
//            "password"=> "123H@1234"
//        ]);
//
//        $response
//            ->assertStatus(200)
//            ->assertJson([
//                "token" => true
//            ]);
//    }


//    public function test_login_user(){
//
//        $user = User::factory()->create([
//            'username' => 'newUser5',
//            'password' => bcrypt('password'),
//        ]);
//        $response = $this->postJson("/auth/login",[
//            "username"=> "newUser5",
//            "password"=> "password"
//        ]);
//
//        $response
//            ->assertStatus(200)
//            ->assertJson([
//                "access_token"=> true
//            ]);
//    }

    public function test_logout_user()
    {
        // Create a user
        $user = User::create([
            'username' => 'newUser2',
            'password' => bcrypt('password'),
        ]);
        $credentials = [
            "username" => "newUser2",
            "password" => "password"
        ];
        $token = JWTAuth::attempt($credentials);

        // Login the user
        $response = $this
            ->actingAs($user)
            ->withHeaders([
                "Authorization" => "Bearer" . $token,
            ])
            ->post("/auth/logout");

        $this->assertFalse(Auth::check());
        $response->assertStatus(200);
    }


}
