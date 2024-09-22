<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $fillable = ['accommodation_id', 'type', 'capacity', 'price','room_photo'];

    public function accommodation()
    {
        return $this->belongsTo(Accommodation::class);
    }
}
