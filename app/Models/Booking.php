<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'hotel_id',
        'room_id',
        'user_id',
        'check_in',
        'check_out',
        'number_of_guests',
        'cost_per_night',
        'total_cost',
        'special_requests',
        'status',
        'booking_reference',
        'payment_status'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'check_in' => 'datetime',
        'check_out' => 'datetime',
        'cost_per_night' => 'decimal:2',
        'total_cost' => 'decimal:2',
        'number_of_guests' => 'integer',
    ];

    /**
     * Get the hotel associated with the booking.
     */
    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    /**
     * Get the room associated with the booking.
     */
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * Get the user who made the booking.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Calculate the number of nights for the booking.
     */
    public function getNumberOfNightsAttribute()
    {
        return $this->check_in->diffInDays($this->check_out);
    }

    /**
     * Calculate the total cost before saving.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($booking) {
            if (empty($booking->total_cost)) {
                $booking->total_cost = $booking->cost_per_night * $booking->getNumberOfNightsAttribute();
            }
            if (empty($booking->booking_reference)) {
                $booking->booking_reference = 'BK-' . strtoupper(uniqid());
            }
        });
    }
}
