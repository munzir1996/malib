<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PitchComment extends Model
{
    protected $guarded = [];
    protected $with = ['customer'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function pitch()
    {
        return $this->belongsTo(Pitch::class);
    }
}
