<?php

namespace App\Http\Controllers\Manager;
use App\Http\Controllers\Controller;
use App\Http\Requests\Manager\StoreSuccessRatingRequest;
use App\Http\Requests\Manager\UpdateSuccessRatingRequest;
use App\Http\Resources\SucessRatingResource;
use Illuminate\Http\Request;

class SchoolSuccessRate extends Controller
{
    public function index()
    {   
        return SucessRatingResource::collection(auth('manager')->user()->school->successRatings);
    }


    public function store(StoreSuccessRatingRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['schoolID'] = auth('manager')->user()->schoolID;
        $successRating = auth('manager')->user()->school->successRatings()->create($validatedData);

        return new SucessRatingResource($successRating);
    }


    public function show($successRatingId)
    {
        $successRating = auth('manager')->user()->school->successRatings()->find($successRatingId);

        if (!$successRating) {
            return response()->json(['error' => 'Success rating not found'], 404);
        }

        return new SucessRatingResource($successRating);
    }

    public function update(UpdateSuccessRatingRequest $request, $successRatingId)
    {
        $successRating = auth('manager')->user()->school->successRatings()->find($successRatingId);

        if (!$successRating) {
            return response()->json(['error' => 'Success rating not found'], 404);
        }

        $validatedData = $request->validated();
        
        $successRating->update($validatedData);

        return new SucessRatingResource($successRating);
    }

    public function destroy($schoolId)
    {
        $successRating = auth('manager')->user()->school->successRatings()->findOrFail($schoolId);

      

        $successRating->delete();

        return response()->json(null, 204);
    }
}
