<?php

namespace Tests\Feature;

use App\Models\Plan;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class TenancyPlanTest extends TestCase
{
    // User Register
    use RefreshDatabase;
    public function testTenantPlanCreate()
    {
        $this->artisan('migrate:fresh --seed');

        $response = $this->postJson('/api/login', [
            'email' => 'user1@mail.com',
            'password' => '12345678',
        ]);

        $token = $response['data']['token'];
        $headers = ['Authorization' => 'Bearer ' . $token];
        
        
        $response2 = $this->postJson('/api/plans', [
            'plan' => "1",
            'company' => 'sss',
            'domain' => 'sss',
        ],$headers);

        $user_id = Auth::user()->id;
        $plan = $response2['data']['plan'];
        $company = $response2['data']['company'];

        // $domain = $response2['data']['domain']; //not working. I don't know. I will fix it leter
        $domain = $response2['data']['domain'].rand(1,100);
        
        $tenant = Tenant::create();
        $tenant->domains()->create(['domain'=>$domain]);

        $plan = Plan::create([
            'user' => $user_id,
            'plan' => $plan,
            'company' => $company,
            'domain' => $domain,
        ]);

        $response2->assertStatus(200);
        $response2->assertJsonStructure([
            'status',
            'message',
            'tenant_id',
            'data'
        ]);

        $response2->assertJson([
            'status' => 'Success',
            'message' => 'Successfully Created Tenant Plan!',
            'tenant_id'=> !null,
            'data' => [
                'user' => !null,
                'plan' => !null,
                'company' => !null,
                'domain' => !null,
                'updated_at' => !null,
                'created_at' => !null,
                'id' => !null,
            ]
        ]);
    }
}
