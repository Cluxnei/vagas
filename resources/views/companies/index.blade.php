@extends('adminlte::page')

@section('title', 'Empresas')

@section('content_header')
    <h1>Empresas</h1>
    <a href="{{ route('companies.create') }}" class="float-right btn btn-info btn-block">
        <i class="fas fa-plus-circle" aria-hidden="true"></i>
    </a>
@stop

@section('content')
    <table class="table table-dark">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Email</th>
                <th scope="col">Cidade</th>
                <th scope="col">ediar</th>
                <th scope="col">deletar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($companies as $company)
            <tr>
                <th scope="row">{{ $company->id }}</th>
                <td>{{ $company->name }}</td>
                <td>{{ $company->email }}</td>
                <td>{{ $company->city->name }}</td>
                <td>
                    <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-info">
                        <i class="fas fa-edit"></i>
                    </a>
                </td>
                <td>
                    <form action="{{ route('companies.destroy', $company->id) }}" method="POST" class="delete-form">
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
