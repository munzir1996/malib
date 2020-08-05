<?php

namespace App\Http\Controllers\API\Owners;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\OwnerStoreRequest as APIOwnerStoreRequest;
use App\Http\Requests\API\OwnerUpdateRequest as APIOwnerUpdateRequest;
use App\Http\Resources\OwnerCollection;
use App\Http\Resources\Owner as OwnerResource;
use App\Owner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class OwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $owners = Owner::all();

        return new OwnerCollection($owners);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(APIOwnerStoreRequest $request)
    {
        $request->validated();

        Owner::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => Hash::make($request->password),
        ]);
        return response()->json('Owner Created', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Owner  $owner
     * @return \Illuminate\Http\Response
     */
    public function show(Owner $owner)
    {
        return new OwnerResource($owner);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Owner  $owner
     * @return \Illuminate\Http\Response
     */
    public function update(APIOwnerUpdateRequest $request, Owner $owner)
    {
        $request->validated();

        if ($request->filled('password')) {
            $request->password = Hash::make($request->password);
        }

        $owner->update($request->all());

        return response()->json("Owner Updated", 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Owner  $owner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Owner $owner)
    {
        //
    }
}
