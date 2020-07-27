<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pitch extends Model
{
    protected $guarded = [];

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }

    public function pitchSchedules()
    {
        return $this->hasMany(PitchSchedule::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

}
