<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        switch(Auth::user()->role){
            case 1:
                return redirect()->route('admin.home');
            case 2:
                return redirect()->route('teacher.home');
            case 3:
                return redirect()->route('student.home');
            default:
                response('Authenticate failed', 401);
        }
    }
}
