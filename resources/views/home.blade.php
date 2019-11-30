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
                        @unless($jobs->isEmpty())
                            @foreach($jobs as $job)
                                <a href="{{ route('jobs.userView', $job->id) }}" class="text-black text-decoration-none">
                                    <div class="alert alert-info">
                                        <h4 class="alert-heading">{{ $job->title }}</h4>
                                        <p>
                                            <b>Empresa:&nbsp;</b>{{ $job->company->name }}<br>
                                            Semestre de início: {{ $job->beginning_semester}}<br>
                                            Semestre de término: {{ $job->final_semester }}
                                        </p>
                                        <hr>
                                        <p class="mb-0">
                                            <b>Requisitos:</b><br>
                                            {{ $job->shortRequirement }}<br>
                                            <b>Benefícios:</b><br>
                                            {{ $job->shortBenefits }}
                                        </p>
                                        @if($job->link)
                                        <hr>
                                        <a href="{{ $job->link }}" target="_blank" class="text-decoration-none">
                                            <ins class="">Acesse o link da vaga</ins>
                                        </a>
                                        @endif
                                    </div>
                                </a>
                                <hr>
                            @endforeach
                        @endunless
                    @endisset
                </div>
            </div>
        </div>
    </div>
@stop
