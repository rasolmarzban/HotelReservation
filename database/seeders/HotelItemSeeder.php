<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HotelItemSeeder extends Seeder
{
    public function run(): void
    {
        $roomIds = DB::table('rooms')->pluck('id'); // Assuming you have a 'rooms' table

        foreach ($roomIds as $roomId) {
            for ($i = 1; $i <= 5; $i++) {
                DB::table('hotel_items')->insert([
                    'name' => 'Room Item ' . rand(100, 999),
                    'description' => $this->getExtraFeature(),
                    'price' => rand(100, 500),
                    'quantity' => rand(1, 3),
                    'category' => $this->getRoomType(),
                    'status' => 'available',
                    'room_id' => $roomId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    private function getRoomType()
    {
        $roomTypes = ['Furniture', 'Appliance', 'Amenity', 'Electronics'];
        return $roomTypes[array_rand($roomTypes)];
    }

    private function getExtraFeature()
    {
        $features = ['Luxury bedding', 'Mini-bar', 'Coffee machine', 'Smart TV', 'Art pieces'];
        return $features[array_rand($features)];
    }
}
