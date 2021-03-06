@extends('adminlte::page')

@section('title', 'Cursos')

@section('content_header')
    <h1>Cursos</h1>
@stop

@section('content')
<section class="content">
    <div class="row">
      <!-- full column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Editar {{ $course->name }}</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" method="POST" action="{{ route('courses.update', $course->id) }}">
            @csrf
            @method('PUT')
            <div class="box-body">
              <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" maxlength="200" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name" id="name" placeholder="Nome do curso" value="{{ $course->name ?? old('name') }}">
                @if ($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
              </div>
              <div class="form-group">
                <label for="semesters">Semestres</label>
                <input type="number" max="10" min="1" class="form-control {{ $errors->has('semesters') ? 'is-invalid' : '' }}" id="semesters" name="semesters" placeholder="Números de semestres" value="{{ $course->semesters ?? old('semesters') }}">
                @if ($errors->has('semesters'))
                    <div class="invalid-feedback">
                        {{ $errors->first('semesters') }}
                    </div>
                @endif
              </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
              <button type="submit" class="btn btn-primary">enviar</button>
            </div>
          </form>
        </div>
        <!-- /.box -->

      </div>
      <!--/.col (full) -->
    </div>
    <!-- /.row -->
  </section>
@stop
