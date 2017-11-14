<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentManagingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::orderBy('name')->paginate(10);

        return view('admin.student.index', ['students' => $students]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.student.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StudentRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentRequest $request)
    {
        $student = new Student();

        $student->fill([
            'student_id' => request()->student_id,
            'password' => \Hash::make('123'),
            'name' => request()->name,
            'birthday' => request()->birthday,
            'email' => request()->email
        ]);

        if(isset(request()->avatar)) {
            $imagePath = $request->file('avatar')->storeAs(
                'public/students/avatars',
                $student->student_id
            );
            $student->fill(['avatar' => $imagePath]);
        }

        $student->save();

        return redirect()->route('admin.student.index')
            ->with('success','Student profile created successfully ');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Student::findOrFail($id);

        return view('admin.student.show', ['student' => $student]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::findOrFail($id);

        return view('admin.student.edit', ['student' => $student]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StudentRequest|Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StudentRequest $request, $id)
    {
        $student = Student::findOrFail($id);

        $imagePath = $student->avatar;

        if(isset($request->avatar)) {
            $imagePath = $request->file('avatar')->storeAs(
                'public/students/avatars',
                $student->student_id
            );
        }

        $student->update([
            'student_id' => request()->student_id,
            'name' => request()->name,
            'birthday' => request()->birthday,
            'email' => request()->email,
            'avatar' => $imagePath,
        ]);

        return redirect()->route('admin.student.show', ['student' => $id])
            ->with('success','Student profile updated successfully ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Student::findOrFail($id)->delete();

        return redirect()->route('admin.student.index')
            ->with('success','Student info deleted successfully');
    }

    public function search(){
        $students = Student::where('name', 'like', '%'.request()->name.'%')->orderBy('name')->paginate(10);

        return view('admin.student.index', ['students' => $students]);
    }
}
