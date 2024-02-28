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
        $user = User::where('email', 'admin@example.com')->first();

        if (!$user) {
            User::factory()->create([
                'name' => 'admin',
                'email' => 'admin@example.com',
                'password' => '123'
            ]);
        }

        User::factory(10)->create();
    }
}
