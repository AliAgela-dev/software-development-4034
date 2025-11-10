<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Note\StoreNoteRequest;
use App\Http\Requests\User\Note\UpdateNoteRequest;
use App\Http\Resources\NoteResource;
use App\Models\Note;
use Illuminate\Http\Request;
use Pest\Mutate\Mutators\String\NotEmptyStringToEmpty;

class UserNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notes = auth('api')->user()->notes;
        return NoteResource::collection($notes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNoteRequest $request)
    {
        auth('api')->user()->notes()->create($request->validated());

        return response()->json(["message" => "Note created successfully"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        return NoteResource::make($note);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNoteRequest $request, Note $note)
    {
        if(auth('api')->id() !== $note->userID) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        $note->update($request->validated());

        return response()->json(["message" => "Note updated successfully"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        if(auth('api')->id() !== $note->userID) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        $note->delete();
        return response()->json(["message" => "Note deleted successfully"]);
    }
}
