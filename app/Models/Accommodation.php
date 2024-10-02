<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accommodation extends Model
{
    use HasFactory;
    protected $table = 'accommodation';

    protected $fillable = ['name', 'description', 'address', 'main_photo', 'type', 'city', 'country'];

    public function photos()
    {
        return $this->hasMany(Photo::class, 'accommodation_id', 'id');
    }
    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
    public function amenities()
    {
        return $this->belongsToMany(Amenity::class, 'accommodation_amenity');
    }
}
