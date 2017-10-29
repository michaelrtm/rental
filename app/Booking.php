<?php

namespace App;

use App\Pump;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $guarded = [];
    protected $dates = [
        'start_date', 'end_date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pump()
    {
        return $this->belongsTo(Pump::class);
    }
}
