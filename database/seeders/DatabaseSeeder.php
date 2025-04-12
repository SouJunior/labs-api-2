<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\PermissionsSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // User::factory(10)->create();

        if (!User::where('email', 'test1@example.com')->exists()) {
            User::factory()->create([
                'name' => 'Test User',
                'email' => 'test1@example.com',
                'password' => bcrypt('password'),
            ]);
        }

        $this->call(PermissionsSeeder::class);
    }
}
