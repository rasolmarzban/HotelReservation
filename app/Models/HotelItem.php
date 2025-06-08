<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HotelItem extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'quantity',
        'category',
        'status',
        'room_id',
        'hotel_id'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price' => 'decimal:2',
        'quantity' => 'integer',

    ];

    /**
     * Get the room that owns the item.
     */
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * Get the hotel that owns the item.
     */
    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
}
