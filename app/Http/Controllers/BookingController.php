<?php
// app/Http/Controllers/BookingController.php
namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use App\Models\Hotel;
use App\Models\HotelItem;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function create($hotelId, $roomId)
    {
        // Get the hotel and room details
        $hotel = Hotel::findOrFail($hotelId);
        $room = Room::findOrFail($roomId);

        return view('bookings.create', compact('hotel', 'room'));
    }

    public function store(Request $request)
    {
        // Validate the incoming booking request
        $validated = $request->validate([
            'hotel_id' => 'required|exists:hotels,id',
            'room_id' => 'required|exists:rooms,id',
            'check_in' => 'required|date|after:today',
            'check_out' => 'required|date|after:check_in',
            'guests' => 'required|integer|min:1',
        ]);

        // Get the hotel
        $hotel = Hotel::findOrFail($validated['hotel_id']);

        // Check if hotel has a price set
        if (!$hotel->price_per_night) {
            return redirect()->back()
                ->with('error', 'This hotel does not have a price set. Please contact the hotel administrator.');
        }

        // Calculate the number of nights and cost
        $checkInDate = Carbon::parse($validated['check_in']);
        $checkOutDate = Carbon::parse($validated['check_out']);
        $numberOfNights = $checkInDate->diffInDays($checkOutDate);
        $costEstimate = $hotel->price_per_night * $numberOfNights;

        // Create the booking
        $booking = Booking::create([
            'hotel_id' => $validated['hotel_id'],
            'room_id' => $validated['room_id'],
            'user_id' => Auth::id(),
            'check_in' => $validated['check_in'],
            'check_out' => $validated['check_out'],
            'number_of_guests' => $validated['guests'],
            'cost_per_night' => $hotel->price_per_night,
            'total_cost' => $costEstimate,
            'status' => 'pending',
            'booking_reference' => 'BK-' . strtoupper(uniqid()),
            'payment_status' => 'pending'
        ]);

        // Redirect with success message
        return redirect()->route('hotels.show', $hotel)
            ->with('success', 'Your booking has been created successfully! Booking reference: ' . $booking->booking_reference);
    }

    public function show(Booking $booking)
    {
        // Load the related hotel and room data
        $booking->load(['hotel', 'room']);

        return view('bookings.show', compact('booking'));
    }
}
