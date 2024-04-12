<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        for($i=0; $i<11; $i++){
            $name = 'user'.$i;
            $email = 'user'.$i.'@mail.com';
            User::factory()->create([
                'name' => $name,
                'email' => $email,
                'password' => '$2y$12$QwXpyS/v0NpxOXVMaWabYuX4OmV.tjfPJT0ob1X83M.X.VGYgZu7y', //12345678
            ]);
        }

        
    }
}
