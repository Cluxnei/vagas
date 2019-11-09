@extends('adminlte::page')

@section('title', 'Empresa')

@section('content_header')
    <h1>Empresa</h1>
@stop

@section('content')
<section class="content">
    <div class="row">
      <!-- full column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Nova Vaga</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" method="POST" action="{{ route('jobs.store') }}">
            @csrf
            <div class="box-body">
              <div class="form-group">
                <label for="title">Título</label>
                <input type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" name="title" id="title" placeholder="Título da Vaga" value="{{ old('title') }}">
                @if ($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
              </div>
              <div class="form-group">
                <label for="beginning_semester">Semestre de inicio</label>
                <input type="number" class="form-control {{ $errors->has('beginning_semester') ? 'is-invalid' : '' }}" id="beginning_semester" name="beginning_semester" placeholder="Semestre de inicio" value="{{ old('beginning_semester') }}">
                @if ($errors->has('beginning_semester'))
                    <div class="invalid-feedback">
                        {{ $errors->first('beginning_semester') }}
                    </div>
                @endif
              </div>
              <div class="form-group">
                <label for="final_semester">Semestre de inicio</label>
                <input type="number" class="form-control {{ $errors->has('final_semester') ? 'is-invalid' : '' }}" id="final_semester" name="final_semester" placeholder="Semestre de término" value="{{ old('final_semester') }}">
                @if ($errors->has('final_semester'))
                    <div class="invalid-feedback">
                        {{ $errors->first('final_semester') }}
                    </div>
                @endif
              </div>
              <div class="form-group">
                <label for="requirement">Requisitos</label>
                <textarea class="form-control {{ $errors->has('requirement') ? 'is-invalid' : '' }}" id="requirement" name="requirement">
                    {{ old('requirement') }}
                </textarea>
                @if ($errors->has('requirement'))
                    <div class="invalid-feedback">
                        {{ $errors->first('requirement') }}
                    </div>
                @endif
              </div>
              <div class="form-group">
                <label for="benefits">Benefícios</label>
                <textarea class="form-control {{ $errors->has('benefits') ? 'is-invalid' : '' }}" id="benefits" name="benefits">
                    {{ old('benefits') }}
                </textarea>
                @if ($errors->has('benefits'))
                    <div class="invalid-feedback">
                        {{ $errors->first('benefits') }}
                    </div>
                @endif
              </div>
                <div class="form-group">
                    <label for="link">Link</label>
                    <input type="url" class="form-control {{ $errors->has('link') ? 'is-invalid' : '' }}" name="link" id="link" placeholder="Link da vaga" value="{{ old('link') }}">
                    @if ($errors->has('link'))
                        <div class="invalid-feedback">
                            {{ $errors->first('link') }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="select2 form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                        <option value="pendent" selected>Pendente</option>
                        <option value="published">Público</option>
                        <option value="archived">Arquivado</option>
                    </select>
                    @if ($errors->has('status'))
                        <div class="invalid-feedback">
                            {{ $errors->first('status') }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="course_id">Cursos</label>
                    <select multiple class="select2 form-control {{ $errors->has('course_id') ? 'is-invalid' : '' }}" name="course_id[]">
                        <option value="">Selecione os cursos</option>
                        @foreach($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('course_id'))
                        <div class="invalid-feedback">
                            {{ $errors->first('course_id') }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="name">Empresa</label>
                    <select class="select2 form-control {{ $errors->has('company_id') ? 'is-invalid' : '' }}" name="company_id">
                        <option value="">Selecione uma cidade</option>
                        @foreach($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('company_id'))
                        <div class="invalid-feedback">
                            {{ $errors->first('company_id') }}
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
