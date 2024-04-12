<?php

namespace Database\Seeders;

use App\Models\Plan;
use App\Models\Tenant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TenantPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user_id = 1;
        $plan = 1;
        $company = 'demo';
        $domain = 'demo.localhost';

        $tenant = Tenant::create();
        $tenant->domains()->create(['domain'=>$domain]);

        $plan = Plan::create([
            'user' => $user_id,
            'plan' => $plan,
            'company' => $company,
            'domain' => $domain,
        ]);
    }
}
