<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HotelSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('hotels')->insert([
            [
                'name' => 'Hotel One',
                'popularity' => 5,
                'location' => '123 Beach Ave',
                'city' => 'Miami',
                'province' => 'Florida',
                'country' => 'USA',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Hotel Two',
                'popularity' => 4,
                'location' => '456 Mountain Rd',
                'city' => 'Denver',
                'province' => 'Colorado',
                'country' => 'USA',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more hotel records as needed
        ]);

        // Retrieve the IDs of the inserted hotels
        $hotelOneId = DB::table('hotels')->where('name', 'Hotel One')->value('id');
        $hotelTwoId = DB::table('hotels')->where('name', 'Hotel Two')->value('id');

        // Insert corresponding hotel images
        $hotelOneImage = 'images/RR-Standard-2-Queen.jpg';
        $hotelTwoImage = 'images/297757014.jpg';

        DB::table('hotel_images')->insert([
            [
                'hotel_id' => $hotelOneId,
                'image_path' => $hotelOneImage,
                'is_primary' => true,
                'order' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'hotel_id' => $hotelTwoId,
                'image_path' => $hotelTwoImage,
                'is_primary' => true,
                'order' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
