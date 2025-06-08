<?php

namespace Database\Seeders;

use App\Models\Countries;
use Illuminate\Database\Seeder;
use App\Models\Country;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    public function run(): void
    {
        $countries = [
            ['name' => 'USA', 'flag' => '🇺🇸'],
            ['name' => 'Canada', 'flag' => '🇨🇦'],
            ['name' => 'UK', 'flag' => '🇬🇧'],
        ];

        foreach ($countries as $country) {
            DB::table('countries')->updateOrInsert(
                ['name' => $country['name']],
                [
                    'flag' => $country['flag'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
