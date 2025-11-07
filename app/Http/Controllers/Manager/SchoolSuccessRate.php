<?php

namespace App\Http\Controllers\Manager;
use App\Http\Controllers\Controller;
use App\Http\Requests\Manager\StoreSuccessRatingRequest;
use App\Http\Requests\Manager\UpdateSuccessRatingRequest;
use App\Http\Resources\SucessRatingResource;
use Illuminate\Http\Request;

class SchoolSuccessRate extends Controller
{
    public function index($schoolId)
    {
        return SucessRatingResource::collection(auth('api')->user()->school->successRatings);
    }


    public function store(StoreSuccessRatingRequest $request)
    {
        $validatedData = $request->validated();
        if(isset($validatedData['schoolID']) && $validatedData['schoolID'] != auth('api')->user()->schoolID){
            return response()->json(['error' => 'Unauthorized school ID'], 403);
        }

        $successRating = auth('api')->user()->school->successRatings()->create($validatedData);

        return new SucessRatingResource($successRating);
    }


    public function show($successRatingId)
    {
        $successRating = auth('api')->user()->school->successRatings()->find($successRatingId);

        if (!$successRating) {
            return response()->json(['error' => 'Success rating not found'], 404);
        }

        return new SucessRatingResource($successRating);
    }

    public function update(UpdateSuccessRatingRequest $request, $successRatingId)
    {
        $successRating = auth('api')->user()->school->successRatings()->find($successRatingId);

        if (!$successRating) {
            return response()->json(['error' => 'Success rating not found'], 404);
        }

        $validatedData = $request->validated();

        $successRating->update($validatedData);

        return new SucessRatingResource($successRating);
    }

    public function destroy($schoolId, $gradeId)
    {
        $successRating = auth('api')->user()->school->successRatings()->where('gradeID', $gradeId)->first();

        if (!$successRating) {
            return response()->json(['error' => 'Success rating not found'], 404);
        }

        $successRating->delete();

        return response()->json(null, 204);
    }
}
