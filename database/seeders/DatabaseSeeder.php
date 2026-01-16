<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\CreditOfferSeeder;
use Database\Seeders\KlientSeeder;
use Database\Seeders\PracownikSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => bcrypt('password'),
            ]
        );
        $this->call([
            RolePermissionSeeder::class,
            CreditOfferSeeder::class,
            KlientSeeder::class,
            PracownikSeeder::class,
            WniosekKredytowySeeder::class,
            OcenaSeeder::class,
            KredytSeeder::class,
            
        ]);
    }
}