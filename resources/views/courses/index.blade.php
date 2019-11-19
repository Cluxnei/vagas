@extends('adminlte::page')

@section('title', 'Cursos')

@section('content_header')
    <h1>Cursos</h1>
    <a href="{{ route('courses.create') }}" class="float-right btn btn-info btn-block">
        <i class="fas fa-plus-circle" aria-hidden="true"></i>
    </a>
@stop

@section('content')
    <table class="table table-dark">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Semestres</th>
                <th scope="col">Usuários</th>
                <th scope="col">ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($courses as $course)
            <tr>
                <th scope="row">{{ $course->id }}</th>
                <td>{{ $course->name }}</td>
                <td>{{ $course->semesters }}</td>
                <td>{{ $course->users()->count() }}</td>
                <td>
                    <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-info">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('courses.destroy', $course->id) }}" method="POST">
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
