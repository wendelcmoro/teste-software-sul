<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Book;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->admin()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        User::factory()->user()->create([
            'name' => 'User',
            'email' => 'user@example.com',
        ]);

        Book::factory()->count(10)->create();
    }
}
