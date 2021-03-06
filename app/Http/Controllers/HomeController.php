<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Throwable;

class HomeController extends Controller
{
    public function index()
    {
        try {
            $jobs = auth()->user()->course->jobs()->published()->orderBy('id', 'desc')->get();
        } catch (Throwable $ex) {
            $jobs = collect([]);
        }
        $hr = date('H');
        $saudation = ($hr < 12 ? 'Bom dia' : ($hr < 18 ? 'Boa tarde' : 'Boa noite')) . ', ' . auth()->user()->name;
        return view('home', compact('jobs', 'saudation'));
    }

    public function search(Request $request)
    {
        $search = '%' . $request->q . '%';
        $jobs = Job::orWhere('title', 'LIKE', $search)
            ->orWhere('beginning_semester', 'LIKE', $search)
            ->orWhere('final_semester', 'LIKE', $search)
            ->orWhere('requirement', 'LIKE', $search)
            ->orWhere('benefits', 'LIKE', $search)
            ->published()
            ->join('companies', 'companies.id', 'jobs.company_id')
            ->orWhere('companies.name', 'LIKE', $search)
            ->select('jobs.id', 'jobs.title')
            ->join('courses_jobs', 'courses_jobs.job_id', 'jobs.id')
            ->select('courses_jobs.course_id')
            ->join('courses', 'courses_jobs.course_id', 'courses.id')
            ->orWhere('courses.name', 'LIKE', $search)
            ->orWhere('courses.semesters', 'LIKE', $search)
            ->select('jobs.*')
            ->get()->unique();
        $hr = date('H');
        $saudation = ($hr < 12 ? 'Bom dia' : ($hr < 18 ? 'Boa tarde' : 'Boa noite')) . ', ' . auth()->user()->name;
        return view('home', compact('saudation', 'jobs'));
    }
}
