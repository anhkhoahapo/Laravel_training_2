<?php

namespace App\Http\Controllers\Student;

use App\Models\SchoolClass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClassRegisterController extends Controller
{
    public function getClassList(){
        $classes = SchoolClass::paginate(10);
        return view('student.list-classes', ['classes' => $classes]);
    }

    public function searchBySubjectName(Request $request){
        $classes = SchoolClass::where('name', 'like', '%'.request()->name.'%')->orderBy('name')->paginate(10);
        return view('student.list-classes', ['classes' => $classes]);
    }
}
