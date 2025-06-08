<?php

namespace Database\Seeders;

use App\Models\Countries;
use App\Models\Provinces;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usa = Countries::where('name', 'USA')->first()->id;
        $canada = Countries::where('name', 'Canada')->first()->id;

        Provinces::insert([
            ['name' => 'California', 'country_id' => $usa, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Florida', 'country_id' => $usa, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Ontario', 'country_id' => $canada, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
