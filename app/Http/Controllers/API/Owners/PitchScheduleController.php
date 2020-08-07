<?php

namespace App\Http\Controllers\API\Owners;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\API\PitchScheduleStoreRequest as APIPitchScheduleStoreRequest;
use App\Http\Requests\API\PitchShceduleUpdateRequest as APIPitchScheduleUpdateRequest;
use App\Http\Resources\PitchScheduleCollection;
use App\Http\Resources\PitchSchedule as PitchScheduleResource;
use App\Pitch;
use App\PitchSchedule;

class PitchScheduleController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(APIPitchScheduleStoreRequest $request)
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
    public function update(APIPitchScheduleUpdateRequest $request, PitchSchedule $pitchschedule)
    {
        $request->validated();

        $pitchschedule->update($request->all());
    }
}
