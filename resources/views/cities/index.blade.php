@extends('adminlte::page')

@section('title', 'Cidades')

@section('content_header')
    <h1>Cidades</h1>
    <a href="{{ route('cities.create') }}" class="float-right btn btn-info btn-block">
        <i class="fas fa-plus-circle" aria-hidden="true"></i>
    </a>
@stop

@section('content')
    <table class="table table-dark">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">UF</th>
                <th scope="col">ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cities as $city)
            <tr>
                <th scope="row">{{ $city->id }}</th>
                <td>{{ $city->name }}</td>
                <td>{{ $city->uf }}</td>
                <td>
                    <a href="{{ route('cities.edit', $city->id) }}" class="btn btn-info">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('cities.destroy', $city->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@stop
