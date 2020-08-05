<?php

namespace App\Http\Controllers\API\Customers;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\PitchCommentStoreRequest;
use App\Http\Resources\PitchCollection;
use App\Http\Resources\PitchCommentCollection;
use App\Pitch;
use App\PitchComment;
use Illuminate\Http\Request;

class PitchCommentController extends Controller
{

    public function index(Pitch $pitch)
    {
        return new PitchCommentCollection($pitch->pitchComments);
    }

    public function store(PitchCommentStoreRequest $request)
    {
        $data = $request->validated();

        PitchComment::create($data);

        return response()->json('Comment Created', 200);

    }

}
