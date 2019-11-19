<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = City::all();
        return view('cities.index', compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cities.create');
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
            'uf' => ['required', 'string', 'max:2'],
        ]);
        $data['uf'] = strtoupper($data['uf']);
        try {
            $city = City::create($data);
            return redirect()->route('cities.index')->with(['error' => false, 'message' => "{$city->name} adicionada."]);
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with(['error' => true, 'message' => 'Erro ao adicionar cidade']);
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
            $city = City::findOrFail($id);
            $name = $city->name;
            $city->delete();
            return redirect()->route('cities.index')->with(['error' => false, 'message' => "{$name} deletada."]);
        } catch (\Throwable $th) {
            $message = isset($city) && $city->companies()->count() != 0 ? 'Essa cidade possue empresas' : 'Cidade não encontrada';
            return redirect()->back()->with(['error' => true, 'message' => $message]);
        }
    }
}
