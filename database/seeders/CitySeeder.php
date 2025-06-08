<?php
namespace Database\Seeders;

use App\Models\Cities;
use App\Models\Provinces;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    public function run(): void
    {
        $california = Provinces::where('name', 'California')->first()->id;
        $florida = Provinces::where('name', 'Florida')->first()->id;
        $ontario = Provinces::where('name', 'Ontario')->first()->id;

        Cities::insert([
            ['name' => 'Los Angeles', 'province_id' => $california, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'San Francisco', 'province_id' => $california, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Miami', 'province_id' => $florida, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Toronto', 'province_id' => $ontario, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
