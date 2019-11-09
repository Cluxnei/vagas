@extends('adminlte::page')

@section('title', 'Vagas')

@section('content_header')
    <h1>Vagas</h1>
    <a href="{{ route('jobs.create') }}" class="float-right btn btn-info btn-block">
        <i class="fas fa-plus-circle" aria-hidden="true"></i>
    </a>
@stop

@section('content')
    <table class="table table-dark">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Título</th>
                <th scope="col">Empresa</th>
                <th scope="col">Administrador</th>
                <th scope="col">status</th>
                <th scope="col">ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jobs as $job)
            <tr>
                <th scope="row">{{ $job->id }}</th>
                <td>{{ $job->title }}</td>
                <td>{{ $job->company->name }}</td>
                <td>{{ $job->administrator->name }}</td>
                <td>
                    <div class="input-group-btn open">
                        <button type="button" class="btn btn-warning btn-block dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                            @if($job->isPublished())
                            <i class="fas fa-globe-americas text-white"></i>
                            @elseif($job->isPendent())
                            <i class="fas fa-circle-notch text-white"></i>
                            @else
                            <i class="fas fa-archive text-white"></i>
                            @endif
                        </button>
                        <ul class="dropdown-menu w-50 p-1">
                            @if($job->isPublished())
                            <li>
                                <a href="{{ route('jobs.changeStatus', ['archived', $job->id]) }}" class="btn btn-block btn-info p-2">
                                    <i class="fas fa-archive"></i>
                                </a>
                            </li>
                            @elseif($job->isPendent())
                            <li>
                                <a href="{{ route('jobs.changeStatus', ['published', $job->id]) }}" class="btn btn-block btn-info p-2">
                                    <i class="fas fa-globe-americas"></i>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="{{ route('jobs.changeStatus', ['archived', $job->id]) }}" class="btn btn-block btn-info p-2">
                                    <i class="fas fa-archive"></i>
                                </a>
                            </li>
                            @else
                            <li>
                                <a href="{{ route('jobs.changeStatus', ['published', $job->id]) }}" class="btn btn-block btn-info p-2">
                                    <i class="fas fa-globe-americas"></i>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </td>
                <td>
                    <div class="d-flex justify-content-around">
                        <a href="{{ route('jobs.show', $job->id) }}" class="btn btn-success">
                            <i class="fas fa-eye"></i>
                        </a>
                        <form action="{{ route('jobs.destroy', $job->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@stop
