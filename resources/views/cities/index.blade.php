@extends('adminlte::page')

@section('title', 'Cidades')

@section('content_header')
    <h1>Cidades</h1>
@stop

@section('content')
    <table class="table table-dark">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">UF</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cities as $city)
            <tr>
                <th scope="row">{{ $city->id }}</th>
                <td>{{ $city->name }}</td>
                <td>{{ $city->uf }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@stop
