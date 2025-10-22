<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Rating\StoreRatingRequest;
use App\Http\Requests\User\Rating\UpdateRatingRequest;
use App\Http\Resources\RatingResource;
use App\Models\Rating;

class RatingController extends Controller
{
    public function index()
    {
        $ratings = Rating::all();
        return RatingResource::collection($ratings);
    }

    public function store(StoreRatingRequest $request)
    {
        $rating = Rating::create($request->validated());
        return new RatingResource($rating);
    }

    public function show(Rating $rating)
    {
        return new RatingResource($rating);
    }

    public function update(UpdateRatingRequest $request, Rating $rating)
    {
        $rating->update($request->validated());
        return new RatingResource($rating);
    }

    public function destroy(Rating $rating)
    {
        $rating->delete();
        return response()->json(null, 204);
    }
}
