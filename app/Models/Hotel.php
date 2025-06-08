<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\City;
use App\Models\Province;
use App\Models\Country;
use App\Models\Cities;
use App\Models\Provinces;
use App\Models\Countries;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'popularity',
        'location',
        'city',
        'province',
        'country',
        'image_path',
        'description',
        'number_of_rooms',
        'number_of_bathrooms',
        'area',
        'capacity',
        'price_per_night',
        'rating',
        'has_pool',
        'has_jacuzzi',
        'has_wifi',
        'has_parking',
        'owner_name',
        'owner_phone',
        'owner_email',
        'address',
        'user_id'
    ];

    protected $casts = [
        'has_pool' => 'boolean',
        'has_jacuzzi' => 'boolean',
        'has_wifi' => 'boolean',
        'has_parking' => 'boolean',
        'price_per_night' => 'decimal:2',
        'rating' => 'decimal:1',
        'area' => 'decimal:2'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function hotelItems()
    {
        return $this->hasMany(HotelItem::class);
    }

    public function images()
    {
        return $this->hasMany(HotelImage::class)->orderBy('order');
    }

    public function primaryImage()
    {
        return $this->hasOne(HotelImage::class)->where('is_primary', true);
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    // Define relationship with City
    public function city()
    {
        return $this->belongsTo(Cities::class, 'city');
    }

    // Define relationship with Province
    public function province()
    {
        return $this->belongsTo(Provinces::class, 'province');
    }

    // Define relationship with Country
    public function country()
    {
        return $this->belongsTo(Countries::class, 'country');
    }
}
