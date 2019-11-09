@extends('adminlte::page')

@section('title', 'Usuários')

@section('content_header')
    <h1>Usuários</h1>
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
                <th scope="col">curso</th>
                <th scope="col">status</th>
                <th scope="col">ação</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <th scope="row">{{ $user->id }}</th>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->cpf }}</td>
                <td>{{ $user->rg }}</td>
                <td>{{ $user->ra }}</td>
                <td>{{ $user->course->name }}</td>
                <td>
                    <span style="opacity: 0;">{{ $user->approved }}</span>
                    <i class="fas fa-{{ $user->isApproved() ? 'unlock' : 'lock'}}"></i>
                </td>
                <td>
                @if($user->isApproved())
                <a href="{{ route('users.reject', $user->id) }}" class="btn btn-danger">
                    <i class="fas fa-lock"></i>
                </a>
                @else
                <a href="{{ route('users.approve', $user->id) }}" class="btn btn-success">
                    <i class="fas fa-unlock"></i>
                </a>
                @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@stop
