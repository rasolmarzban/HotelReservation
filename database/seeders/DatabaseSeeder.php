<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            CountrySeeder::class,
            ProvinceSeeder::class,
            CitySeeder::class,
            HotelSeeder::class,
            HotelItemSeeder::class,
            UserSeeder::class,
        ]);
    }
}
