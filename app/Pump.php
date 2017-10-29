<?php

namespace App;

use App\Booking;
use Illuminate\Database\Eloquent\Model;

class Pump extends Model
{
    protected $guarded = [];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
