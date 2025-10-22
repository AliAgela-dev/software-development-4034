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
        $teachers = $school->teachers;
        return SchoolTeacherResource::collection($teachers);
    }

    public function store(AssignTeacherToSchoolRequest $request, School $school)
    {
        $school->teachers()->attach($request->teacherID, ['gradeID' => $request->gradeID]);

        return response()->json(['message' => 'Teacher assigned successfully.']);
    }

    public function update(UpdateSchoolTeacherRequest $request, School $school, Teacher $teacher)
    {
        $school->teachers()->updateExistingPivot($teacher->id, ['gradeID' => $request->gradeID]);

        return response()->json(['message' => 'Teacher assignment updated successfully.']);
    }

    public function destroy(School $school, Teacher $teacher)
    {
        $school->teachers()->detach($teacher->id);

        return response()->json(null, 204);
    }
}
