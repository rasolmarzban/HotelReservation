<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
    use HasFactory;

    protected $fillable = ['name','flag'];

    // A country has many provinces
    public function provinces()
    {
        return $this->hasMany(provinces::class);
    }
}
