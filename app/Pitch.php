<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Pitch extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $guarded = [];
    protected $with = ['area', 'owner'];


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

    public function pitchComments()
    {
        return $this->hasMany(PitchComment::class);
    }

}
