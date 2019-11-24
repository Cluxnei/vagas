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
                        <h3 class="box-title">Editar {{ $company->name }}</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" method="POST" action="{{ route('companies.update', $company->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="box-body">
                            <div class="form-group">
                                <label for="name">Nome</label>
                                <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                       name="name" id="name" placeholder="Nome do curso"
                                       value="{{ $company->name ?? old('name') }}">
                                @if ($errors->has('name'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('name') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="semesters">Email</label>
                                <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                       id="email" name="email" placeholder="Email da empresa"
                                       value="{{ $company->email ?? old('email') }}">
                                @if ($errors->has('email'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('email') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="name">Cidade</label>
                                <select class="select2 form-control {{ $errors->has('city_id') ? 'is-invalid' : '' }}"
                                        name="city_id">
                                    @php $c = $company->city; @endphp
                                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                                    @foreach($cities as $city)
                                        @unless($city->id == $c->id)
                                            <option value="{{ $city->id }}">{{ $city->name }} ({{ $city->uf }})</option>
                                        @endunless
                                    @endforeach
                                </select>
                                @if ($errors->has('city_id'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('city_id') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="phone">Telefone</label>
                                <input type="text" class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}"
                                       id="phone" name="phone" placeholder="Telefone da empresa"
                                       value="{{ $company->phone ?? old('phone') }}">
                                @if ($errors->has('phone'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('phone') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="site">Site</label>
                                <input type="url" class="form-control {{ $errors->has('site') ? 'is-invalid' : '' }}"
                                       id="site" name="site" placeholder="Site da empresa"
                                       value="{{ $company->site ?? old('site') }}">
                                @if ($errors->has('site'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('site') }}
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
