@extends('adminlte::page')

@section('title', 'Usuários Administradores')

@section('content_header')
    <h1>Usuários Administratores</h1>
@stop

@section('content')
    <table class="table table-dark">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Email</th>
                <th scope="col">cpf</th>
                <th scope="col">rg</th>
                <th scope="col">ra</th>
            </tr>
        </thead>
        <tbody>
            @foreach($administrators as $administrator)
            <tr>
                <th scope="row">{{ $administrator->id }}</th>
                <td>{{ $administrator->name }}</td>
                <td>{{ $administrator->email }}</td>
                <td>{{ $administrator->cpf }}</td>
                <td>{{ $administrator->rg }}</td>
                <td>{{ $administrator->ra ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@stop
