<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Booking extends Model
{
    protected $guarded = [];
    // protected $with = ['pitch', 'customer', 'pitchSchedule'];

    public function scopeBooked($query){

        return $query->where('status', Config::get('constants.booking.status_booked'))->whereHas('pitch', function (Builder $query) {
            $query->where('owner_id', auth()->id());
        });

    }

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
