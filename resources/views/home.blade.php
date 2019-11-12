@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">{{ $saudation ?? 'Bom dia' }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @isset($jobs)
                    @if(!$jobs->isEmpty())
                    @foreach($jobs as $job)
                    <a href="{{ route('jobs.userView', $job->id) }}">
                        {{ $job->title }}
                    </a>
                    @endforeach
                    @endif
                    @endisset
                    @isset($result)
                    @if(!$result->isEmpty())
                    @foreach($result as $job)
                    <a href="{{ route('jobs.userView', $job->id) }}">
                        {{ $job->title }}
                    </a>
                    @endforeach
                    @endif
                    @endisset
                </div>
            </div>
        </div>
    </div>
@stop
