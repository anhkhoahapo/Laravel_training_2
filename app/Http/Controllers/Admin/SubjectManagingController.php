<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSubject;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectManagingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subject::orderBy('name')->paginate(10);

        return view('admin.subject.index', ['subjects' => $subjects]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.subject.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Controllers\Admin\StoreSubject|Storesubject|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubject $request)
    {
        Subject::create($request->all());

        return redirect()->route('admin.subject.index')
            ->with('success', 'New subject created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subject = Subject::findOrFail($id);

        return view('admin.subject.show', ['subject' => $subject]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subject = Subject::findOrFail($id);

        return view('admin.subject.edit', ['subject' => $subject]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Storesubject|Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Storesubject $request, $id)
    {
        $subject = Subject::findOrFail($id);

        $subject->update($request->all());

        return redirect()->route('admin.subject.show', ['subject' => $id])
            ->with('success','subject profile updated successfully ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Subject::findOrFail($id)->delete();

        return redirect()->route('admin.subject.index')
            ->with('success','subject info deleted successfully');
    }

    public function search(){
        $subjects = Subject::where('name', 'like', '%'.request()->name.'%')->orderBy('name')->paginate(10);

        return view('admin.subject.index', ['subjects' => $subjects]);
    }
}
