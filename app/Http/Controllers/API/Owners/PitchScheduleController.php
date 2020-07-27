<?php

namespace App\Http\Controllers\API\Owners;

use App\Http\Controllers\Controller;
use App\Http\Requests\PitchScheduleStoreRequest;
use App\Http\Requests\PitchScheduleUpdateRequest;
use App\Http\Resources\PitchScheduleCollection;
use App\Http\Resources\PitchSchedule as PitchScheduleResource;
use App\PitchSchedule;
use Illuminate\Http\Request;

class PitchScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pitchSchedules = PitchSchedule::with('pitch')->get();

        return new PitchScheduleCollection($pitchSchedules);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PitchScheduleStoreRequest $request)
    {
        $request->validated();

        PitchSchedule::create($request->all());

        return response()->json('Pitch Schedule Created', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PitchSchedule  $pitchSchedule
     * @return \Illuminate\Http\Response
     */
    public function show(PitchSchedule $pitchschedule)
    {
        return new PitchScheduleResource($pitchschedule);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PitchSchedule  $pitchSchedule
     * @return \Illuminate\Http\Response
     */
    public function update(PitchScheduleUpdateRequest $request, PitchSchedule $pitchschedule)
    {
        $request->validated();

        $pitchschedule->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PitchSchedule  $pitchSchedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(PitchSchedule $pitchschedule)
    {
        //
    }
}
