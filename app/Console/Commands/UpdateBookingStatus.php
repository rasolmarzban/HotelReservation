<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Booking;
use Carbon\Carbon;

class UpdateBookingStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bookings:update-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update booking and room statuses based on check-in and check-out dates';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();

        // Update bookings that have started
        $activeBookings = Booking::where('status', 'confirmed')
            ->where('check_in', '<=', $now)
            ->where('check_out', '>', $now)
            ->get();

        foreach ($activeBookings as $booking) {
            $booking->update(['status' => 'checked_in']);
            $this->info("Booking {$booking->booking_reference} marked as checked in");
        }

        // Update bookings that have ended
        $endedBookings = Booking::whereIn('status', ['confirmed', 'checked_in'])
            ->where('check_out', '<=', $now)
            ->get();

        foreach ($endedBookings as $booking) {
            $booking->update(['status' => 'checked_out']);

            // Make the room available again
            $booking->room->update([
                'status' => 'available',
                'is_available' => true
            ]);

            $this->info("Booking {$booking->booking_reference} marked as checked out and room {$booking->room->room_number} made available");
        }

        $this->info('Booking statuses updated successfully');
    }
}
