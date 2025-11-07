<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Resources\SucessRatingResource;
use App\Models\SuccessRating;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;

class SchoolSuccessRate extends Controller
{
    public function index()
    {
        return SucessRatingResource::collection(SuccessRating::all());
    }

    public function show($schoolId)
    {
        $successRating = SuccessRating::where('schoolID', $schoolId)->get();

        return  SucessRatingResource::collection($successRating);
    }

}
