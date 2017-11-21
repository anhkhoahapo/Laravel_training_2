<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ClassRequest;
use App\Http\Requests\UpdateStudentScore;
use App\Models\SchoolClass;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClassManagingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = SchoolClass::with(['teacher', 'subject' => function($query){
            $query->orderBy('name');
        }])->paginate(10);

        return view('admin.class.index', ['classes' => $classes ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjects = Subject::select('id', 'name')->get()->all();
        $teachers = Teacher::select('id', 'teacher_id', 'name')->get()->all();

        return view('admin.class.create', ['teachers' => $teachers, 'subjects' => $subjects]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ClassRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClassRequest $request)
    {
        $class = SchoolClass::create($request->all());

        return redirect()->route('admin.class.show', ['class' => $class])
            ->with('success', 'Class created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $class = SchoolClass::findOrFail($id);
        return view('admin.class.show', ['class' => $class]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subjects = Subject::select('id', 'name')->get()->all();
        $teachers = Teacher::select('id', 'teacher_id', 'name')->get()->all();
        $class = SchoolClass::findOrFail($id);
        return view('admin.class.edit', ['class' => $class, 'teachers' => $teachers, 'subjects' => $subjects]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ClassRequest|Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClassRequest $request, $id)
    {
        $class = SchoolClass::findOrFail($id);

        $class->update($request->all());

        if($class->teacher_id === Null){
            $class->students()->detach();
        }

        return redirect()->route('admin.class.show', ['class' => $id])
            ->with('success', 'Class updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SchoolClass::findOrFail($id)->delete();

        return redirect()->route('admin.class.index')
            ->with('success','Class deleted successfully');
    }

    public function updateStudentScore(UpdateStudentScore $request, $class_id){
        $class = SchoolClass::with('students')->findOrFail($class_id);

        foreach($request->get('score') as $student => $score){
            $class->students()->updateExistingPivot($student, ['score' => $score]);
        }
        return redirect()->route('admin.class.show', ['class' => $class_id])
            ->with('success', 'Update score successfully');
    }
}
