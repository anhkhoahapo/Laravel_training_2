<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Support\Facades\Hash;

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

    public function showChangePasswordForm(){
        return view('teacher.change-password');
    }

    public function changePassword(ChangePasswordRequest $request){
        $teacher = auth()->guard('teacher')->user();

        if(!Hash::check($request->old_password, $teacher->password)){
            return redirect()->route('teacher.changePassword')
                ->withErrors(['old_password' => 'Password does not match']);
        }

        $teacher->update(['password' => bcrypt($request->password)]);

        return view('teacher.home');
    }

    public function registeredClasses(){
        $teacher = auth()->guard('teacher')->user();
        $classes = $teacher->schoolClasses()->paginate(10);
        return view('teacher.registered-classes', ['classes' => $classes]);
    }
}
