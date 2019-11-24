<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Throwable;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $courses = Course::all();
        return view('courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('courses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
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
        } catch (Throwable $th) {
            return redirect()->back()->withInput()->with(['error' => true, 'message' => 'Erro ao adicionar curso.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $course = Course::findOrFail($id);
        return view('courses.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'min:2'],
            'semesters' => ['required'],
        ]);
        try {
            $course->update($data);
            return redirect()->route('courses.index')->with(['error' => false, 'message' => "{$request->name} atualizado."]);
        } catch (Throwable $th) {
            return redirect()->back()->withInput()->with(['error' => true, 'message' => 'Erro ao atualizar curso.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        try {
            $course = Course::findOrFail($id);
            $name = $course->name;
            $course->delete();
            $message = "{$name} deletado.";
            return redirect()->route('courses.index')->with(['error' => false, 'message' => $message]);
        } catch (Throwable $th) {
            $message = 'Curso não encontrado.';
            if (isset($course)) {
                $hasJobs = $course->jobs()->count() != 0;
                $hasUsers = $course->users()->count() != 0;
                $message = 'Esse curso possue ' . ($hasJobs ? 'vagas' : ($hasUsers ? 'usuários' : '')) . ' associados(as).';
            }
            return redirect()->route('courses.index')->with(['error' => true, 'message' => $message]);
        }
    }
}
