<?php

namespace App\Http\Controllers\Manager;
use App\Http\Controllers\Controller;
use App\Http\Resources\SucessRatingResource;
use App\Models\SuccessRating;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;

class SchoolSuccessRate extends Controller
{
    public function index($schoolId)
    {
        return SucessRatingResource::collection(SuccessRating::all());
    }

    public function show($successRatingId)
    {
        $successRating = SuccessRating::findOrFail($successRatingId);

        return new SucessRatingResource($successRating);
    }

}
