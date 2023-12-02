<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'DevLord',
            'email' => 'dev@gmail.com',
            'role' => 'admin',
            'password'=> '12345678'
        ]);
        User::factory(2)->create();

        $this->call([
            ProductSeeder::class,
            CategorySeeder::class,
            CategoryProductSeeder::class,
        ]);
    }
}
