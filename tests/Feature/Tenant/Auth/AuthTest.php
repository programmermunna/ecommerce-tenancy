<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TenantAuthTest extends TestCase
{
    // User Register
    use RefreshDatabase;
    public function testUserRegister()
    {
        
        $response = $this->postJson('/api/register', [
            'name' => "user 1",
            'email' => 'user1@gmail.com',
            'password' => '12345678',
            'password_confirmation' => '12345678',
        ],);

        
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'message',
            'data'
        ]);

        $response->assertJson([
            'success' => 'true',
            'message' => 'Successfully Registered! Now, Login!',
            'data' => []
        ]);
    }

    // User Login
    public function testUserLogin()
    {
        User::create([
            'name' => "user 1",
            'email' => 'user1@gmail.com',
            'password' => '12345678',
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'user1@gmail.com',
            'password' => '12345678',
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'message',
            'data'
        ]);

        $response->assertJson([
            'success' => 'true',
            'message' => 'Login Token Generated Successfully!',
            'data' => [
                'token' => !null
            ]
        ]);    

       
    }

    // User Logout
    public function testUserLogout()
    {
        User::create([
            'name' => "user 1",
            'email' => 'user1@gmail.com',
            'password' => '12345678',
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'user1@gmail.com',
            'password' => '12345678',
        ]);

        $token = $response['data']['token'];
        $headers = ['Authorization' => 'Bearer ' . $token];

        $response2 = $this->deleteJson('/api/logout', [], $headers);  

        $response2->assertStatus(200);

        $response2->assertJsonStructure([
            'success',
            'message',
            'data'
        ]);

        $response2->assertJson([
            'success' => 'true',
            'message' => 'Successfully Logout!',
            'data' => []
        ]);       
    }
}
