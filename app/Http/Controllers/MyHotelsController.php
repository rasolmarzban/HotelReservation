<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Booking;
use Illuminate\Http\Request;

class MyHotelsController extends Controller
{
    public function index()
    {
        $myHotels = Hotel::where('user_id', auth()->id())
            ->withCount(['rooms as available_rooms_count' => function ($query) {
                $query->where('status', 'available');
            }])
            ->get();

        $myBookings = Booking::with(['hotel', 'room'])
            ->where('user_id', auth()->id())
            ->get();

        $hotelBookingRequests = Booking::with(['hotel', 'room', 'user'])
            ->whereHas('hotel', function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->where('status', 'pending')
            ->get();

        return view('hotels.my-hotels', compact('myHotels', 'myBookings', 'hotelBookingRequests'));
    }
}
