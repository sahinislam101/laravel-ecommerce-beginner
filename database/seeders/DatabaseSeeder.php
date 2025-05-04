<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin user generate (only if not exists)
        User::firstOrCreate(
            ['email' => 'sahinislam1012@gmail.com'],
            [
                'name' => 'Sahin Islam',
                'password' => bcrypt('sahin1012'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ]
        );
    
        // Call other seeders
        $this->call([
            CategorySeeder::class,
            ProductSeeder::class,
        ]);
    }
}

   
