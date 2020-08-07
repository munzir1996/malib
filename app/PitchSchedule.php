<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class PitchSchedule extends Model
{
    protected $guarded = [];

    public function pitch()
    {
        return $this->belongsTo(Pitch::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

}
