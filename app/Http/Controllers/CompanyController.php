<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::all();
        return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::all();
        return view('companies.create', compact('cities'));
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'unique:companies', 'email', 'string', 'max:255'],
            'city_id' => ['required'],
        ]);
        try {
            $company = Company::create($data);
            return redirect()->route('companies.index')->with(['error' => false, 'message' => "{$company->name} adicionada."]);
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with(['error' => true, 'message' => 'Erro ao adicionar empresa']);
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
        $cities = City::all();
        $company = Company::findOrFail($id);
        return view('companies.edit', compact('company', 'cities'));
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
        $company = Company::findOrFail($id);
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'string', 'max:255'],
            'city_id' => ['required'],
        ]);
        try {
            $company->update($data);
            return redirect()->route('companies.index')->with(['error' => false, 'message' => "{$request->name} atualizada."]);
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with(['error' => true, 'message' => 'Erro ao atualizar empresa']);
        }
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
            $company = Company::findOrFail($id);
            $name = $company->name;
            $company->delete();
            return redirect()->route('companies.index')->with(['error' => false, 'message' => "{$name} deletada."]);
        } catch (\Throwable $th) {
            $message = (isset($company) && $company->jobs()->count() != 0) ? 'Essa empresa possue vagas associadas.' : 'Empresa não encontrada';
            return redirect()->back()->with(['error' => true, 'message' => $message]);
        }
    }
}
