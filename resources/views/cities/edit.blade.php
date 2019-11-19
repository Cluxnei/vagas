@extends('adminlte::page')

@section('title', 'Cidades')

@section('content_header')
    <h1>Cidade</h1>
@stop

@section('content')
<section class="content">
    <div class="row">
      <!-- full column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Editar {{ $city->name }}</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" method="POST" action="{{ route('cities.update', $city->id) }}">
            @csrf
            @method('PUT')
            <div class="box-body">
              <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name" id="name" placeholder="Nome da cidade" value="{{ $city->name ?? old('name') }}">
                @if ($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
              </div>
              <div class="form-group">
                <label for="uf">UF</label>
                <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="uf" name="uf" placeholder="UF" value="{{ $city->uf ?? old('uf') }}">
                @if ($errors->has('uf'))
                    <div class="invalid-feedback">
                        {{ $errors->first('uf') }}
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
