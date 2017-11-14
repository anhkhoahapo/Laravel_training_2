<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeacherRequest;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherManagingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachers = Teacher::orderBy('name')->paginate(10);

        return view('admin.teacher.index', ['teachers' => $teachers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.teacher.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TeacherRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(TeacherRequest $request)
    {
        $teacher = new Teacher();

        $teacher->fill([
            'teacher_id' => request()->teacher_id,
            'password' => \Hash::make('123'),
            'name' => request()->name,
            'birthday' => request()->birthday,
            'email' => request()->email
        ]);

        if(isset(request()->avatar)) {
            $imagePath = $request->file('avatar')->storeAs(
                'public/teachers/avatars',
                $teacher->teacher_id
            );
            $teacher->fill(['avatar' => $imagePath]);
        }

        $teacher->save();

        return redirect()->route('admin.teacher.index')
            ->with('success','Teacher profile created successfully ');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $teacher = Teacher::findOrFail($id);

        return view('admin.teacher.show', ['teacher' => $teacher]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $teacher = Teacher::findOrFail($id);

        return view('admin.teacher.edit', ['teacher' => $teacher]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TeacherRequest|Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(TeacherRequest $request, $id)
    {
        $teacher = Teacher::findOrFail($id);

        $imagePath = $teacher->avatar;

        if(isset($request->avatar)) {
            $imagePath = $request->file('avatar')->storeAs(
                'public/teachers/avatars',
                $teacher->teacher_id
            );
        }

        $teacher->update([
            'teacher_id' => request()->teacher_id,
            'name' => request()->name,
            'birthday' => request()->birthday,
            'email' => request()->email,
            'avatar' => $imagePath,
        ]);

        return redirect()->route('admin.teacher.show', ['teacher' => $id])
            ->with('success','Teacher profile updated successfully ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Teacher::findOrFail($id)->delete();

        return redirect()->route('admin.teacher.index')
            ->with('success','Teacher info deleted successfully');
    }

    public function search(){
        $teachers = Teacher::where('name', 'like', '%'.request()->name.'%')->orderBy('name')->paginate(10);

        return view('admin.teacher.index', ['teachers' => $teachers]);
    }
}
