<?php

namespace App\Http\Controllers\API\Customers;

use App\Area;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\AreaCollection;
use App\Http\Resources\Area as AreaResource;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $areas = Area::all();

        return new AreaCollection($areas);
    }
}
