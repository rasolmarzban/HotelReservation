<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'province_id'];

    // A city belongs to one province
    public function province()
    {
        return $this->belongsTo(provinces::class);
    }
}
