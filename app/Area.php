<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $guarded = [];

    public function pitchs()
    {
        return $this->hasMany(Pitch::class);
    }

}
