<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('student.home');
    }

    public function registeredClasses(){
        $student = \Auth::guard('student')->user();
        $classes = $student->schoolClasses()->paginate(10);
        return view('student.registered-classes', ['classes' => $classes]);
    }
}
