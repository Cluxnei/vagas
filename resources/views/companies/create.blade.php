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
            <h3 class="box-title">Nova Empresa</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" method="POST" action="{{ route('companies.store') }}">
            @csrf
            <div class="box-body">
              <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name" id="name" placeholder="Nome do curso" value="{{ old('name') }}">
                @if ($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
              </div>
              <div class="form-group">
                <label for="semesters">Email</label>
                <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email" name="email" placeholder="Email da empresa" value="{{ old('email') }}">
                @if ($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
              </div>
              <div class="form-group">
                    <label for="name">Cidade</label>
                    <select class="select2 form-control {{ $errors->has('city_id') ? 'is-invalid' : '' }}" name="city_id">
                        <option value="">Selecione uma cidade</option>
                        @foreach($cities as $city)
                        <option value="{{ $city->id }}">{{ $city->name }} ({{ $city->uf }})</option>
                        @endforeach
                    </select>
                    @if ($errors->has('city_id'))
                        <div class="invalid-feedback">
                            {{ $errors->first('city_id') }}
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
