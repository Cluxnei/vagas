@extends('adminlte::page')

@section('title', 'Empresa')

@section('content_header')
    <h1>{{ $job->title }}</h1>
@stop

@section('content')
<section class="content">
    <div class="row">
      <!-- full column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
          <!-- /.box-header -->
          <!-- form start -->
          <div>
            <div class="box-body">
              <div class="form-group">
                <label>Semestre de inicio</label>
                <h2 class="form-control">{{ $job->beginning_semester }}</h2>
                <label>Semestre de término</label>
                <h2 class="form-control">{{ $job->final_semester }}</h2>
                <label>Requisitos</label>
                <p>{!! $job->requirement !!}</p>
                <label>Benefícios</label>
                <p>{!! $job->benefits !!}</p>
                @if($job->link)
                <label>Link</label>
                <a href="{{ $job->link}}">{{ $job->link }}</a>
                @endif
                <label>Empresa</label>
                <h2 class="form-control">{{ $job->company->name }}</h2>
                <label>Curso(s)</label>
                <h2 class="form-control">{{ $job->courses->pluck('name')->implode(', ') }}</h2>
              </div>

            </div>
            <!-- /.box-body -->
          </div>
        </div>
        <!-- /.box -->

      </div>
      <!--/.col (full) -->
    </div>
    <!-- /.row -->
  </section>
@stop
