<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $fillable = ['accommodation_id', 'type', 'capacity', 'price'];

    public function accommodation()
    {
        return $this->belongsTo(Accommodation::class);
    }

}
