<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::all();
        return view('courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('courses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'min:2'],
            'semesters' => ['required'],
        ]);
        try {
            $course = Course::create($data);
            return redirect()->route('courses.index')->with(['error' => false, 'message' => "{$course->name} adicionado."]);
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with(['error' => true, 'message' => 'Erro ao adicionar curso.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $course = Course::findOrFail($id);
            $name = $course->name;
            $deleted = $course->delete();
            $hasJobs = $course->jobs()->count() != 0;
            $hasUsers = $course->users()->count() != 0;
            $message = "{$name} deletado.";
            if(!$deleted) $message = ($hasJobs ? 'vagas' : ($hasUsers ? 'usuários' : ''));
            return redirect()->route('courses.index')->with(['error' => !$deleted, 'message' => $message]);
        } catch (\Throwable $th) {
            return redirect()->route('courses.index')->with(['error' => true, 'message' => 'Erro ao deletar curso']);
        }
    }
}
