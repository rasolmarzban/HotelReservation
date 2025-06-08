<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function provinces()
    {
        return $this->hasMany(Province::class);
    }

    public function hotels()
    {
        return $this->hasMany(Hotel::class);
    }
}
