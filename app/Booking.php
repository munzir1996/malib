<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $guarded = [];

    public function pitch()
    {
        return $this->belongsTo(Pitch::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function pitchSchedule()
    {
        return $this->belongsTo(PitchSchedule::class);
    }
}
