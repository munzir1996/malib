<?php

namespace App\Http\Controllers\API\Owners;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\PitchStoreRequest as APIPitchStoreRequest;
use App\Http\Requests\API\PitchUpdateRequest as APIPitchUpdateRequest;
use App\Http\Resources\PitchCollection;
use App\Http\Resources\Pitch as Pitchresource;
use App\Pitch;
use Illuminate\Http\Request;

class PitchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pitchs = Pitch::all();

        return new PitchCollection($pitchs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(APIPitchStoreRequest $request)
    {
        $request->validated();

        Pitch::create($request->all());

        return response()->json('Pitch Created', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pitch  $pitch
     * @return \Illuminate\Http\Response
     */
    public function show(Pitch $pitch)
    {
        return new Pitchresource($pitch);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pitch  $pitch
     * @return \Illuminate\Http\Response
     */
    public function update(APIPitchUpdateRequest $request, Pitch $pitch)
    {
        $pitch->update($request->all());

        return response()->json($pitch);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pitch  $pitch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pitch $pitch)
    {
        //
    }
}
