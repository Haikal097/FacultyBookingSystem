<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'capacity',
        'building',
        'status',
        'description',
        'price_per_hour',
        'price_fullday'
    ];

    public function bookings()
{
    return $this->hasMany(Booking::class);
}
}

