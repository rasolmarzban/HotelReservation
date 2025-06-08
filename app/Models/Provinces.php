<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinces extends Model
{
    use HasFactory;

    // A province belongs to one country
    protected $fillable = ['name', 'country_id'];

    public function country()
    {
        return $this->belongsTo(Countries::class);
    }

    // A province has many cities
    public function cities()
    {
        return $this->hasMany(Cities::class);
    }
}
