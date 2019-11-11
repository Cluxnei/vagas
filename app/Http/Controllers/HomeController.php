<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        try {
            $jobs = auth()->user()->course->jobs()->published()->orderBy('id', 'desc')->get();
        } catch (\Exception $ex) {
            $jobs = collect([]);
        }
        $hr = date('h');
        $saudation = ($hr < 12 ? 'Bom dia' : ($hr < 18 ? 'Boa tarde' : 'Boa noite')) . ', ' . auth()->user()->name;
        return view('home', compact('jobs', 'saudation'));
    }

    public function search(Request $request)
    {
        $search = $request->q;
        dd($search);
    }
}
