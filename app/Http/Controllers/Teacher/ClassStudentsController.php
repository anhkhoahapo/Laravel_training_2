<?php

namespace App\Http\Controllers\Teacher;

use App\Models\SchoolClass;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClassStudentsController extends Controller
{
    public function getListStudent($class_id){
        $class = SchoolClass::with('students')->findOrFail($class_id);

        return view('teacher.class-students', ['class' => $class]);
    }

    public function updateStudentScore(Request $request, $class_id){
        $class = SchoolClass::with('students')->findOrFail($class_id);

        $class->students()->sync(collect($request->get('score'))->map(function ($item, $key) {
            return ['score' => $item];
        })->all());

        return redirect()->route('teacher.class-students', ['class' => $class_id])
            ->with('success', 'Update score successfully');
    }
}
