<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Requests\ClassRegisterRequest;
use App\Models\SchoolClass;
use App\Models\Subject;
use Illuminate\Database\QueryException;
use App\Http\Controllers\Controller;

class ClassRegisterController extends Controller
{
    public function getClassList(){
        $subjects = Subject::with(['schoolClasses' => function ($query){
            $teacher = \Auth::guard('teacher')->user();
            $query->whereNull('teacher_id')->orWhere('teacher_id', '=', $teacher->id);
        }])->orderBy('name')->get()->all();

        return view('teacher.list-classes', ['subjects' => $subjects]);
    }

    public function search(){
        $subjects = Subject::with(['schoolClasses' => function ($query) {
            $query->where('semester', 'like', request()->semester.'%')
                ->whereNull('teacher_id');
        }])->where('name', 'like', '%'.request()->name.'%')
            ->orderBy('name')->get()->all();

        return view('teacher.list-classes', ['subjects' => $subjects]);
    }

    public function register(ClassRegisterRequest $request){
        $class = SchoolClass::findOrFail($request->class_id);

        $teacher = \Auth::guard('teacher')->user();

        $class->update([ 'teacher_id' => $teacher->id ]);

        return redirect()->route('teacher.classes')->with('success', 'Register successfully');
    }

    public function unregister(ClassRegisterRequest $request){
        $class = SchoolClass::findOrFail($request->class_id);

        $teacher = \Auth::guard('teacher')->user();

        $class->update([ 'teacher_id' => Null ]);

        return redirect()->route('teacher.classes')->with('success', 'Unregister successfully');
    }
}
