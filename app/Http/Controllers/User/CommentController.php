<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Comment\StoreCommentRequest;
use App\Http\Requests\User\Comment\UpdateCommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::all();
        return CommentResource::collection($comments);
    }

    public function store(StoreCommentRequest $request)
    {
        $comment = Comment::create($request->validated());
        return new CommentResource($comment);
    }

    public function show(Comment $comment)
    {
        return new CommentResource($comment);
    }

    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        $comment->update($request->validated());
        return new CommentResource($comment);
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return response()->json(null, 204);
    }
}
