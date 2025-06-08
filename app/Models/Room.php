<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'room_number',
        'type',
        'floor',
        'capacity',
        'price_per_night',
        'status',
        'description',
        'is_available',
        'hotel_id'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price_per_night' => 'decimal:2',
        'capacity' => 'integer',
        'floor' => 'integer',
        'is_available' => 'boolean',
    ];

    /**
     * Get the hotel that owns the room.
     */
    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    /**
     * Get all items in the room.
     */
    public function items()
    {
        return $this->hasMany(HotelItem::class);
    }

    /**
     * Get all bookings for the room.
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
