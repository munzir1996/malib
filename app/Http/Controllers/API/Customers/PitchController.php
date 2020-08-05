<?php

namespace App\Http\Controllers\API\Customers;

use App\Area;
use App\Http\Controllers\Controller;
use App\Http\Resources\PitchCollection;
use App\Http\Resources\Pitch as Pitchresource;
use App\Pitch;
use Illuminate\Http\Request;

class PitchController extends Controller
{

    public function index()
    {
        $pitchs = Pitch::all();

        return new PitchCollection($pitchs);
    }

    public function show(Pitch $pitch)
    {

        return new Pitchresource($pitch);

    }

    public function filter(Area $area)
    {

        return new PitchCollection($area->pitchs);

    }


}
