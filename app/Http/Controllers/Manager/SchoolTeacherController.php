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
    public function index()
    {
        $teachers = auth('manager')->user()->school->teachers;
        return SchoolTeacherResource::collection($teachers);
    }

    public function store(AssignTeacherToSchoolRequest $request)
    {
        auth('manager')->user()->school->teachers()->attach($request->teacherID, ['gradeID' => $request->gradeID, 'year' => $request->year]);

        return response()->json(['message' => 'Teacher assigned successfully.']);
    }

    public function update(UpdateSchoolTeacherRequest $request, School $school, Teacher $teacher)
    {
        auth('manager')->user()->school->teachers()->updateExistingPivot($teacher->id, $request->validated());

        return response()->json(['message' => 'Teacher assignment updated successfully.']);
    }

    public function destroy(Teacher $teacher)
    {
        auth('manager')->user()->school->teachers()->detach($teacher->id);
        return response()->json(null, 204);
    }
}
