<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Course;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Throwable;

class JobController extends Controller
{
    public function userView($id)
    {
        $job = Job::findOrFail($id);
        return view('jobs.userView', compact('job'));
    }
    public function changeStatus($status, $id)
    {
        try {
            Job::findOrFail($id)->update([
                'status' => $status,
            ]);
            return redirect()->route('jobs.index')
                ->with([
                    'error' => false,
                    'message' => 'Vaga atualizada.'
                ]);
        } catch (Throwable $th) {
            return redirect()->route('jobs.index')
                ->with([
                    'error' => true,
                    'message' => 'Ero ao atualizar vaga.'
                ]);
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $jobs = Job::orderBy('status', 'asc')->get();
        return view('jobs.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $companies = Company::all();
        $courses = Course::all();
        return view('jobs.create', compact('companies', 'courses'));
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
            'title' => ['required', 'max:255'],
            'requirement' => ['required'],
            'benefits' => ['required'],
            'company_id' => ['required', 'numeric'],
            'course_id' => ['required', 'array'],
            'status' => ['nullable', 'string'],
            'beginning_semester' => ['nullable', 'numeric'],
            'final_semester' => ['nullable', 'numeric'],
            'link' => ['nullable', 'url'],
        ]);

        try {
            $data['administrator_id'] = auth()->user()->id;
            $courses = $data['course_id'];
            unset($data['course_id']);
            $job = Job::create($data);
            $job->courses()->sync($courses);
            return redirect()->route('jobs.index')->with([
                'error' => false,
                'message' => "{$job->title} adicionado.",
            ]);
        } catch (Throwable $th) {
            throw $th;
            return redirect()->route('jobs.index')->with([
                'error' => true,
                'message' => "Erro ao adicionar essa vaga.",
            ]);
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
        try {
            $job = Job::findOrFail($id);
            return view('jobs.show', compact('job'));
        } catch (Throwable $th) {
            return redirect()->route('jobs.index')
                ->with([
                    'error' => true,
                    'message' => "Vaga não encontrada."
                ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $companies = Company::all();
        $courses = Course::all();
        $job = Job::findOrFail($id);
        return view('jobs.edit', compact('courses', 'companies', 'job'));
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
        $data = $request->validate([
            'title' => ['required', 'max:255'],
            'requirement' => ['required'],
            'benefits' => ['required'],
            'company_id' => ['required', 'numeric'],
            'course_id' => ['required', 'array'],
            'status' => ['nullable', 'string'],
            'beginning_semester' => ['nullable', 'numeric'],
            'final_semester' => ['nullable', 'numeric'],
            'link' => ['nullable', 'url'],
        ]);

        try {
            $job = Job::findOrFail($id);
            $data['administrator_id'] = auth()->user()->id;
            $courses = $data['course_id'];
            unset($data['course_id']);
            $job->update($data);
            $job->courses()->sync($courses);
            return redirect()->route('jobs.index')->with([
                'error' => false,
                'message' => "{$job->title} atualizado.",
            ]);
        } catch (Throwable $th) {
            return redirect()->route('jobs.index')->with([
                'error' => true,
                'message' => "Erro ao atualizar essa vaga.",
            ]);
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
            $job = Job::findOrFail($id);
            $title = $job->title;
            $job->courses()->detach();
            $job->delete();
            return redirect()->route('jobs.index')
                ->with([
                    'error' => false,
                    'message' => "{$title} deletado."
                ]);
        } catch (Throwable $th) {
            return redirect()->route('jobs.index')
                ->with([
                    'error' => true,
                    'message' => "Erro ao deletar essa vaga."
                ]);
        }
    }
}
