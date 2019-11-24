<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Throwable;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $cities = City::all();
        return view('cities.index', compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('cities.create');
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
            'name' => ['required', 'string', 'max:255'],
            'uf' => ['required', 'string', 'max:2'],
        ]);
        $data['uf'] = strtoupper($data['uf']);
        try {
            $city = City::create($data);
            return redirect()->route('cities.index')->with(['error' => false, 'message' => "{$city->name} adicionada."]);
        } catch (Throwable $th) {
            return redirect()->back()->withInput()->with(['error' => true, 'message' => 'Erro ao adicionar cidade']);
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
        $city = City::findOrFail($id);
        return view('cities.edit', compact('city'));
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
            'name' => ['required', 'string', 'max:255'],
            'uf' => ['required', 'string', 'max:2'],
        ]);
        $data['uf'] = strtoupper($data['uf']);
        try {
            City::findOrFail($id)->update($data);
            return redirect()->route('cities.index')->with(['error' => false, 'message' => "{$request->name} atualizada."]);
        } catch (Throwable $th) {
            return redirect()->route('cities.index')->with(['error' => true, 'message' => 'Erro ao atualizar cidade']);
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
            $city = City::findOrFail($id);
            $name = $city->name;
            $city->delete();
            return redirect()->route('cities.index')->with(['error' => false, 'message' => "{$name} deletada."]);
        } catch (Throwable $th) {
            $message = isset($city) && $city->companies()->count() != 0 ? 'Essa cidade possue empresas' : 'Cidade não encontrada';
            return redirect()->back()->with(['error' => true, 'message' => $message]);
        }
    }
}
