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
                <th scope="col">visualizar / editar / deletar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jobs as $job)
            <tr>
                <th scope="row">{{ $job->id }}</th>
                <td>{{ $job->shortTitle }}</td>
                <td>{{ $job->company->name }}</td>
                <td>{{ $job->administrator->name }}</td>
                <td>
                    <div class="input-group-btn open">
                        <button type="button" class="btn btn-warning btn-block dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                            @if($job->isPublished())
                            <b class="text-white">publicada&nbsp;</b>
                            <i class="fas fa-globe-americas text-white"></i>
                            @elseif($job->isPendent())
                            <b class="text-white">pendente&nbsp;</b>
                            <i class="fas fa-circle-notch text-white"></i>
                            @else
                            <b class="text-white">arquivada&nbsp;</b>
                            <i class="fas fa-archive text-white"></i>
                            @endif
                        </button>
                        <ul class="dropdown-menu w-50 p-1">
                            @if($job->isPublished())
                            <li>
                                <a href="{{ route('jobs.changeStatus', ['archived', $job->id]) }}" class="btn btn-block btn-info p-2">
                                    <i class="fas fa-archive"></i>
                                    arquivar
                                </a>
                            </li>
                            @elseif($job->isPendent())
                            <li>
                                <a href="{{ route('jobs.changeStatus', ['published', $job->id]) }}" class="btn btn-block btn-info p-2">
                                    <i class="fas fa-globe-americas"></i>
                                    publicar
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="{{ route('jobs.changeStatus', ['archived', $job->id]) }}" class="btn btn-block btn-info p-2">
                                    <i class="fas fa-archive"></i>
                                    arquivar
                                </a>
                            </li>
                            @else
                            <li>
                                <a href="{{ route('jobs.changeStatus', ['published', $job->id]) }}" class="btn btn-block btn-info p-2">
                                    <i class="fas fa-globe-americas"></i>
                                    publicar
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
                        <a href="{{ route('jobs.edit', $job->id) }}" class="btn btn-info">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('jobs.destroy', $job->id) }}" method="POST" class="delete-form">
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
