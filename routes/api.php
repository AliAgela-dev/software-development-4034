<?php

use App\Http\Controllers\Admin\ManagerController;
use App\Http\Controllers\Admin\SchoolController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Manager\GradeController;
use App\Http\Controllers\Manager\FeeController;
use App\Http\Controllers\User\RatingController;
use App\Http\Controllers\User\CommentController;
use App\Http\Controllers\Manager\SchoolTeacherController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('managers', ManagerController::class);
Route::apiResource('schools', SchoolController::class);
Route::apiResource('grades', GradeController::class);
Route::apiResource('teachers', TeacherController::class);
Route::apiResource('fees', FeeController::class);
Route::apiResource('ratings', RatingController::class);
Route::apiResource('comments', CommentController::class);

Route::prefix('schools/{school}')->group(function () {
    Route::get('teachers', [SchoolTeacherController::class, 'index']);
    Route::post('teachers', [SchoolTeacherController::class, 'store']);
    Route::put('teachers/{teacher}', [SchoolTeacherController::class, 'update']);
    Route::delete('teachers/{teacher}', [SchoolTeacherController::class, 'destroy']);
});
