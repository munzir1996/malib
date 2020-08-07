<?php

namespace App\Http\Controllers\API\Customers;

use App\Http\Controllers\Controller;
use App\Http\Resources\PitchScheduleCollection;
use App\Pitch;
use Illuminate\Http\Request;

class PitchScheduleController extends Controller
{

    public function index(Pitch $pitch)
    {

        return new PitchScheduleCollection($pitch->pitchSchedules);

    }

}
