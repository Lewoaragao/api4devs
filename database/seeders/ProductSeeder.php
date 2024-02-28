<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtenha todos os usuários existentes
        $users = User::all();

        // Crie três produtos para cada usuário
        $users->each(function ($user) {
            Product::factory()->count(3)->create(['user_id' => $user->id]);
        });
    }
}