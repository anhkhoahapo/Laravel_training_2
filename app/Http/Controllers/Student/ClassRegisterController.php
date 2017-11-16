<?php

namespace App\Http\Controllers\Student;

use App\Http\Requests\ClassRegisterRequest;
use App\Models\Subject;
use Illuminate\Database\QueryException;
use App\Http\Controllers\Controller;

class ClassRegisterController extends Controller
{
    public function getClassList(){
        $subjects = Subject::with(['schoolClasses' => function ($query){
            $query->whereNotNull('teacher_id');
        }])->orderBy('name')->get()->all();

        return view('student.list-classes', ['subjects' => $subjects]);
    }

    public function search(){
        $subjects = Subject::with(['schoolClasses' => function ($query) {
            $query->where('semester', 'like', request()->semester.'%')
                ->whereNotNull('teacher_id');
        }])->where('name', 'like', '%'.request()->name.'%')
            ->orderBy('name')->get()->all();

        return view('student.list-classes', ['subjects' => $subjects]);
    }

    public function register(ClassRegisterRequest $request){
        $student = \Auth::guard('student')->user();
        try {
            $student->schoolClasses()->attach(request()->class_id);
        }
        catch (QueryException $e){
            if($e->errorInfo[0] === '23000')
                return redirect()->route('student.classes')
                    ->setStatusCode(302)
                    ->with('error', 'You have already registered to this class');
        }

        return redirect()->route('student.classes')->with('success', 'Register successfully');
    }

    public function unregister(ClassRegisterRequest $request){
        $student = \Auth::guard('student')->user();

        $student->schoolClasses()->detach(request()->class_id);

        return redirect()->route('student.classes')->with('success', 'Unregister successfully');
    }
}
