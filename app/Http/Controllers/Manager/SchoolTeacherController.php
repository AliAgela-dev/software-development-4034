<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\Manager\SchoolTeacher\AssignTeacherToSchoolRequest;
use App\Http\Requests\Manager\SchoolTeacher\UpdateSchoolTeacherRequest;
use App\Http\Resources\SchoolTeacherResource;
use App\Models\School;
use App\Models\Teacher;

class SchoolTeacherController extends Controller
{
    public function index(School $school)
    {
        if($school->id !== auth('manager')->user()->schoolID) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $teachers = $school->teachers;
        return SchoolTeacherResource::collection($teachers);
    }

    public function store(AssignTeacherToSchoolRequest $request, School $school)
    {
        if($school->id !== auth('manager')->user()->schoolID) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $school->teachers()->attach($request->teacherID, ['gradeID' => $request->gradeID, 'year' => $request->year]);

        return response()->json(['message' => 'Teacher assigned successfully.']);
    }

    public function update(UpdateSchoolTeacherRequest $request, School $school, Teacher $teacher)
    {
        if($school->id !== auth('manager')->user()->schoolID) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $school->teachers()->updateExistingPivot($teacher->id, $request->validated());

        return response()->json(['message' => 'Teacher assignment updated successfully.']);
    }

    public function destroy(School $school, Teacher $teacher)
    {
        if($school->id !== auth('manager')->user()->schoolID) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $school->teachers()->detach($teacher->id);

        return response()->json(null, 204);
    }
}
