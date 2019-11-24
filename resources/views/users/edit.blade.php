@extends('adminlte::page')

@section('title', 'Admnistradores')

@section('content_header')
    <h1>Admnistradores</h1>
@stop

@section('content')
    <section class="content">
        <div class="row">
            <!-- full column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Editar {{ $user->name }}</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" method="POST"
                          action="{{ route('users.update', $user->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="box-body">
                            <div class="form-group">
                                <label for="name">Nome</label>
                                <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                       name="name" id="name" placeholder="Nome do curso"
                                       value="{{ $user->name ?? old('name') }}">
                                @if ($errors->has('name'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('name') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                       id="email" name="email" placeholder="E-mail"
                                       value="{{ $user->email ?? old('email') }}">
                                @if ($errors->has('email'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('email') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="cpf">CPF</label>
                                <input type="text" class="cpf form-control {{ $errors->has('cpf') ? 'is-invalid' : '' }}"
                                       id="cpf" name="cpf" placeholder="CPF"
                                       value="{{ $user->cpf ?? old('cpf') }}">
                                @if ($errors->has('cpf'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('cpf') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="rg">RG</label>
                                <input type="text" class="rg form-control {{ $errors->has('rg') ? 'is-invalid' : '' }}"
                                       id="rg" name="rg" placeholder="RG"
                                       value="{{ $user->rg ?? old('rg') }}">
                                @if ($errors->has('rg'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('rg') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="ra">RA</label>
                                <input type="text" class="form-control {{ $errors->has('ra') ? 'is-invalid' : '' }}"
                                       id="ra" name="ra" placeholder="RA"
                                       value="{{ $user->rg ?? old('ra') }}">
                                @if ($errors->has('ra'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('ra') }}
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
