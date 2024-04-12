<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        for($i=0; $i<4; $i++){
            $name = 'user'.$i;
            $email = 'user'.$i.'@mail.com';
            User::factory()->create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make('12345678'), //12345678
            ]);
        }

        
    }
}
