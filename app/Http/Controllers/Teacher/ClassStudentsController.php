<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Requests\UpdateStudentScore;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClassStudentsController extends Controller
{
    public function getListStudent($class_id){
        $teacher = auth()->guard('teacher')->user();

        $class = $teacher->schoolClasses()->with('students')->findOrFail($class_id);

        return view('teacher.class-students', ['class' => $class]);
    }

    public function updateStudentScore(UpdateStudentScore $request, $class_id){
        $teacher = auth()->guard('teacher')->user();

        $class = $teacher->schoolClasses()->findOrFail($class_id);

        foreach($request->get('score') as $student => $score){
            $class->students()->updateExistingPivot($student, ['score' => $score]);
        }
        return redirect()->route('teacher.class_students', ['class' => $class_id])
            ->with('success', 'Update score successfully');
    }
}
