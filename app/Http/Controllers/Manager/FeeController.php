<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\Manager\Fee\StoreFeeRequest;
use App\Http\Requests\Manager\Fee\UpdateFeeRequest;
use App\Http\Resources\FeeResource;
use App\Models\Fee;

class FeeController extends Controller
{
    public function index()
    {
        $fees = Fee::where('schoolID', auth('api')->user()->schoolID)->get();
        return FeeResource::collection($fees);
    }

    public function store(StoreFeeRequest $request)
    {
        $request->validated()['schoolID'] = auth('api')->user()->schoolID;
        $fee = Fee::create($request->validated());
        return new FeeResource($fee);
    }

    public function show(Fee $fee)
    {
        if($fee->schoolID !== auth('api')->user()->schoolID) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        return new FeeResource($fee);
    }

    public function update(UpdateFeeRequest $request, Fee $fee)
    {
        if($fee->schoolID !== auth('api')->user()->schoolID) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $fee->update($request->validated());
        return new FeeResource($fee);
    }

    public function destroy(Fee $fee)
    {
        if($fee->schoolID !== auth('api')->user()->schoolID) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $fee->delete();
        return response()->json(null, 204);
    }
}
