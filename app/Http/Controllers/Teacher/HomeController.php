<?php

namespace App\Http\Controllers\Teacher;

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
        return view('teacher.home');
    }

    public function registeredClasses(){
        $teacher = auth()->guard('teacher')->user();
        $classes = $teacher->schoolClasses()->paginate(10);
        return view('teacher.registered-classes', ['classes' => $classes]);
    }
}
