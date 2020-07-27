<?php

namespace App\Http\Controllers\API\Owners;

use App\Area;
use App\Http\Controllers\Controller;
use App\Http\Requests\AreaStoreRequest;
use App\Http\Resources\AreaCollection;
use App\Http\Resources\Area as AreaResource;
use Illuminate\Http\Request;

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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AreaStoreRequest $request)
    {
        $request->validated();

        Area::create($request->all());

        return response()->json('Area Created', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function show(Area $area)
    {
        return new AreaResource($area);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Area $area)
    {
        $area->update($request->all());

        return response()->json('Area Updates', 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function destroy(Area $area)
    {
        //
    }
}
