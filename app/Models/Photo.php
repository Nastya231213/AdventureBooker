<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;
    protected $fillable = ['accommodation_id', 'path'];
   
    public function accommodation()
    {
        return $this->belongsTo(Accommodation::class);
    }
}
