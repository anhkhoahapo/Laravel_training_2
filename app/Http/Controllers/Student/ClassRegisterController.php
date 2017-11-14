<?php

namespace App\Http\Controllers\Student;

use App\Http\Requests\ClassRegisterRequest;
use App\Models\SchoolClass;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClassRegisterController extends Controller
{
    public function getClassList(){
        $semester = request()->semester;
        $classes = SchoolClass::where('semester', 'like', $semester.'%')->paginate(10);
        return view('student.list-classes', ['classes' => $classes]);
    }

    public function searchBySubjectName(Request $request){
        $classes = SchoolClass::where('name', 'like', '%'.request()->name.'%')->orderBy('name')->paginate(10);
        return view('student.list-classes', ['classes' => $classes]);
    }

    public function register(ClassRegisterRequest $request){
        $student = \Auth::guard('student')->user();
        try {
            $student->schoolClasses()->attach(request()->class_id);
        }
        catch (QueryException $e){
            if($e->errorInfo[0] === '23000')
                return redirect()->route('student.classes')->with('error', 'You have already registered to this class');
        }

        return redirect()->route('student.classes')->with('success', 'Register successfully');
    }

    public function unregister(ClassRegisterRequest $request){
        $student = \Auth::guard('student')->user();

        $student->schoolClasses()->detach(request()->class_id);

        return redirect()->route('student.classes')->with('success', 'Unregister successfully');
    }
}
