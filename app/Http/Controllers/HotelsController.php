<?php

namespace App\Http\Controllers;

use App\Models\Cities;
use App\Models\Countries;
use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\Provinces;
use App\Models\Room;

class HotelsController extends Controller
{
    // Display a list of hotels
    public function index()
    {
        $hotels = Hotel::with(['hotelItems', 'city_relation', 'province_relation', 'country_relation'])->get(); // Optimized eager loading

        // Add logging to see the data
        \Log::info('Hotels data being passed to view:', [
            'hotels' => $hotels->map(function ($hotel) {
                return [
                    'id' => $hotel->id,
                    'name' => $hotel->name,
                    'city' => $hotel->city,
                    'province' => $hotel->province,
                    'country' => $hotel->country,
                    'city_relation' => $hotel->city_relation,
                    'province_relation' => $hotel->province_relation,
                    'country_relation' => $hotel->country_relation,
                ];
            })->toArray()
        ]);

        return view('home', compact('hotels'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $hotels = Hotel::with(['hotelItems', 'city_relation', 'province_relation', 'country_relation'])
            ->where('name', 'like', "%{$query}%")
            ->orWhere('location', 'like', "%{$query}%")
            ->orWhereHas('city_relation', function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%");
            })
            ->orWhereHas('province_relation', function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%");
            })
            ->orWhereHas('country_relation', function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%");
            })
            ->get();

        return view('home', compact('hotels'));
    }

    public function test()
    {
        return var_dump("test");
    }

    // Show the form for creating a new hotel
    public function createHotel()
    {
        // Retrieve all countries, provinces, and cities from the database
        $countries = Countries::all();
        $provinces = Provinces::all();
        $cities = Cities::all();

        // Pass the data to the view
        return view('hotels.create', compact('countries', 'provinces', 'cities'));
    }

    public function store(Request $request)
    {
        try {
            // Log the incoming request data
            \Log::info('Hotel creation request started');
            \Log::info('Request data:', $request->all());
            \Log::info('Files in request:', $request->allFiles());

            // Validate the incoming request
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'country' => 'required|exists:countries,id',
                'province' => 'required|exists:provinces,id',
                'city' => 'required|exists:cities,id',
                'location' => 'required|string|max:255',
                'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'description' => 'nullable|string',
                'number_of_rooms' => 'nullable|integer|min:0',
                'number_of_bathrooms' => 'nullable|integer|min:0',
                'area' => 'nullable|numeric|min:0',
                'capacity' => 'nullable|integer|min:0',
                'price_per_night' => 'nullable|numeric|min:0',
                'rating' => 'nullable|numeric|min:0|max:5',
                'has_pool' => 'nullable',
                'has_jacuzzi' => 'nullable',
                'has_wifi' => 'nullable',
                'has_parking' => 'nullable',
                'owner_name' => 'nullable|string|max:255',
                'owner_phone' => 'nullable|string|max:255',
                'owner_email' => 'nullable|email|max:255',
                'address' => 'nullable|string|max:255',
                'rooms' => 'required|array|min:1',
                'rooms.*.room_number' => 'required|string',
                'rooms.*.type' => 'required|string',
                'rooms.*.floor' => 'required|integer|min:1',
                'rooms.*.capacity' => 'required|integer|min:1',
            ]);

            \Log::info('Validated data before creating hotel:', $validated);

            // Set default values for boolean fields
            $validated['has_pool'] = $request->has('has_pool') ? true : false;
            $validated['has_jacuzzi'] = $request->has('has_jacuzzi') ? true : false;
            $validated['has_wifi'] = $request->has('has_wifi') ? true : false;
            $validated['has_parking'] = $request->has('has_parking') ? true : false;

            \Log::info('Boolean fields set:', [
                'has_pool' => $validated['has_pool'],
                'has_jacuzzi' => $validated['has_jacuzzi'],
                'has_wifi' => $validated['has_wifi'],
                'has_parking' => $validated['has_parking']
            ]);

            // Set the user_id
            $validated['user_id'] = auth()->id();
            \Log::info('User ID set:', ['user_id' => $validated['user_id']]);

            // Create the hotel with the validated data
            $hotel = Hotel::create($validated);
            \Log::info('Hotel created successfully:', ['hotel_id' => $hotel->id]);

            // Create rooms for the hotel
            foreach ($request->rooms as $roomData) {
                // Check if room number already exists in this hotel
                $existingRoom = Room::where('hotel_id', $hotel->id)
                    ->where('room_number', $roomData['room_number'])
                    ->first();

                if ($existingRoom) {
                    throw new \Exception("Room number {$roomData['room_number']} already exists in this hotel.");
                }

                $roomData['hotel_id'] = $hotel->id;
                $roomData['price_per_night'] = $hotel->price_per_night;
                $roomData['status'] = 'available';
                $roomData['is_available'] = true;
                $room = Room::create($roomData);
                \Log::info('Room created:', ['room_id' => $room->id, 'room_number' => $room->room_number]);
            }

            // Handle image uploads
            if ($request->hasFile('images')) {
                \Log::info('Processing image uploads');
                foreach ($request->file('images') as $index => $image) {
                    $path = $image->store('hotel-images', 'public');
                    $imageRecord = $hotel->images()->create([
                        'image_path' => $path,
                        'order' => $index,
                        'is_primary' => $index === 0
                    ]);
                    \Log::info('Image uploaded:', ['image_id' => $imageRecord->id, 'path' => $path]);
                }
            } else {
                \Log::info('No images were uploaded');
            }

            \Log::info('Hotel creation completed successfully');
            return redirect()->route('hotels.show', $hotel)
                ->with('success', 'Hotel created successfully!');
        } catch (\Exception $e) {
            \Log::error('Hotel creation error: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            return redirect()->back()
                ->withInput()
                ->with('error', 'An error occurred while creating the hotel. Please try again.');
        }
    }

    // Display the specified hotel
    public function show(Hotel $hotel)
    {
        $hotel->load(['hotelItems', 'images']); // Eager load both hotelItems and images

        // Eager load only available rooms
        $hotel->load(['rooms' => function ($query) {
            $query->where('status', 'available');
        }]);

        return view('hotels.show', compact('hotel'));
    }

    // Show the form for editing the specified hotel
    public function edit(Hotel $hotel)
    {
        $countries = Countries::all();
        $provinces = Provinces::all();
        $cities = Cities::all();
        return view('hotels.edit', compact('hotel', 'countries', 'provinces', 'cities'));
    }

    // Update the specified hotel in the database
    public function update(Request $request, Hotel $hotel)
    {
        try {
            // Validate the incoming request
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'country' => 'required|exists:countries,id',
                'province' => 'required|exists:provinces,id',
                'city' => 'required|exists:cities,id',
                'location' => 'required|string|max:255',
                'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'description' => 'nullable|string',
                'number_of_rooms' => 'nullable|integer|min:0',
                'number_of_bathrooms' => 'nullable|integer|min:0',
                'area' => 'nullable|numeric|min:0',
                'capacity' => 'nullable|integer|min:0',
                'price_per_night' => 'nullable|numeric|min:0',
                'rating' => 'nullable|numeric|min:0|max:5',
                'has_pool' => 'nullable',
                'has_jacuzzi' => 'nullable',
                'has_wifi' => 'nullable',
                'has_parking' => 'nullable',
                'owner_name' => 'nullable|string|max:255',
                'owner_phone' => 'nullable|string|max:255',
                'owner_email' => 'nullable|email|max:255',
                'address' => 'nullable|string|max:255',
                'rooms' => 'required|array|min:1',
                'rooms.*.id' => 'nullable|exists:rooms,id',
                'rooms.*.room_number' => 'required|string',
                'rooms.*.type' => 'required|string',
                'rooms.*.floor' => 'required|integer|min:1',
                'rooms.*.capacity' => 'required|integer|min:1',
            ]);

            \Log::info('Validated data before updating hotel:', $validated);

            // Set default values for boolean fields
            $validated['has_pool'] = $request->has('has_pool') ? true : false;
            $validated['has_jacuzzi'] = $request->has('has_jacuzzi') ? true : false;
            $validated['has_wifi'] = $request->has('has_wifi') ? true : false;
            $validated['has_parking'] = $request->has('has_parking') ? true : false;

            // Update the hotel
            $hotel->update($validated);

            // Update or create rooms
            $existingRoomIds = $hotel->rooms->pluck('id')->toArray();
            $updatedRoomIds = [];

            foreach ($request->rooms as $roomData) {
                if (isset($roomData['id'])) {
                    // Update existing room
                    $room = Room::find($roomData['id']);

                    // Check if room number already exists in this hotel (excluding current room)
                    $existingRoom = Room::where('hotel_id', $hotel->id)
                        ->where('room_number', $roomData['room_number'])
                        ->where('id', '!=', $room->id)
                        ->first();

                    if ($existingRoom) {
                        throw new \Exception("Room number {$roomData['room_number']} already exists in this hotel.");
                    }

                    $room->update([
                        'room_number' => $roomData['room_number'],
                        'type' => $roomData['type'],
                        'floor' => $roomData['floor'],
                        'capacity' => $roomData['capacity'],
                        'price_per_night' => $hotel->price_per_night,
                    ]);
                    $updatedRoomIds[] = $room->id;
                } else {
                    // Check if room number already exists in this hotel
                    $existingRoom = Room::where('hotel_id', $hotel->id)
                        ->where('room_number', $roomData['room_number'])
                        ->first();

                    if ($existingRoom) {
                        throw new \Exception("Room number {$roomData['room_number']} already exists in this hotel.");
                    }

                    // Create new room
                    $roomData['hotel_id'] = $hotel->id;
                    $roomData['price_per_night'] = $hotel->price_per_night;
                    $roomData['status'] = 'available';
                    $roomData['is_available'] = true;
                    $room = Room::create($roomData);
                    $updatedRoomIds[] = $room->id;
                }
            }

            // Delete rooms that were removed
            $roomsToDelete = array_diff($existingRoomIds, $updatedRoomIds);
            if (!empty($roomsToDelete)) {
                Room::whereIn('id', $roomsToDelete)->delete();
            }

            // Handle image uploads
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $index => $image) {
                    $path = $image->store('hotel-images', 'public');
                    $hotel->images()->create([
                        'image_path' => $path,
                        'order' => $hotel->images()->count() + $index,
                        'is_primary' => false
                    ]);
                }
            }

            return redirect()->route('hotels.show', $hotel)
                ->with('success', 'Hotel updated successfully!');
        } catch (\Exception $e) {
            \Log::error('Hotel update error: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            return redirect()->back()
                ->withInput()
                ->with('error', 'An error occurred while updating the hotel. Please try again.');
        }
    }

    // Remove the specified hotel from the database
    public function destroy(Hotel $hotel)
    {
        $hotel->delete();
        return redirect()->route('dashboard')->with('success', 'Hotel deleted successfully.');
    }
}
