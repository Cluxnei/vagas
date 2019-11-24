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
                <th scope="col">editar</th>
                <th scope="col">remover</th>
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
                <td>
                    <a href="{{ route('users.edit', $administrator->id) }}" class="btn btn-info">
                        <i class="fas fa-edit"></i>
                    </a>
                </td>
                <td>
                    <form action="{{ route('users.destroy', $administrator->id) }}" method="POST" class="delete-form">
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
