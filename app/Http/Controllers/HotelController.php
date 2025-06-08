<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class HotelController extends Controller
{
    public function update(Request $request, Hotel $hotel)
    {
        $request->validate([
            'rooms.*.room_number' => [
                'required',
                'integer',
                'distinct',
                'min:1',
                'max:1000',
                function ($attribute, $value, $fail) use ($request, $hotel) {
                    $index = explode('.', $attribute)[1];
                    $roomId = $request->input('rooms.' . $index . '.id');
                    $query = Room::where('room_number', $value)->where('hotel_id', $hotel->id);
                    if ($roomId) {
                        $query->where('id', '!=', $roomId);
                    }
                    if ($query->exists()) {
                        $fail('The room number ' . $value . ' has already been taken for this hotel.');
                    }
                },
            ],
        ]);

        // Rest of the method remains unchanged
    }
}
