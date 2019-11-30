@extends('adminlte::master')

@section('adminlte_css')
    @yield('css')
@stop

@section('classes_body', 'register-page')

@section('body')
    <div class="register-box">
        <div class="register-logo">
            <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}">{!! config('adminlte.logo', '<b>Admin</b>LTE') !!}</a>
        </div>
        <div class="card">
            <div class="card-body register-card-body">
            <p class="login-box-msg">{{ __('adminlte::adminlte.register_message') }}</p>
            <form action="{{ url(config('adminlte.register_url', 'register')) }}" method="post">
                {{ csrf_field() }}

                <div class="input-group mb-3">
                    <input type="text" maxlength="200" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ old('name') }}"
                           placeholder="{{ __('adminlte::adminlte.full_name') }}" required />
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>

                    @if ($errors->has('name'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email') }}"
                           placeholder="{{ __('adminlte::adminlte.email') }}" required />
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    @if ($errors->has('email'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="input-group mb-3">
                    <input type="text" maxlength="200" name="cpf" class="cpf form-control {{ $errors->has('cpf') ? 'is-invalid' : '' }}"
                        value="{{ old('cpf') }}" placeholder="CPF" required>
                    @if ($errors->has('cpf'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('cpf') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="input-group mb-3">
                    <input type="text" maxlength="200" name="rg" class="rg form-control {{ $errors->has('rg') ? 'is-invalid' : '' }}"
                        value="{{ old('rg') }}" placeholder="RG" />
                    @if ($errors->has('rg'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('rg') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="input-group mb-3">
                    <input type="text" maxlength="200" name="ra" class="form-control {{ $errors->has('ra') ? 'is-invalid' : '' }}"
                        value="{{ old('ra') }}" placeholder="RA" />
                    @if ($errors->has('ra'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('ra') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="input-group mb-3">
                    <select name="course_id" class="form-control select2 {{ $errors->has('course_id') ? 'is-invalid' : '' }}" required>
                        @if(old('course_id'))
                        <option value="{{ old('course_id') }}" select>{{ $courses->find(old('course_id'))->name }}</option>
                        @else
                        <option value="">Selecione um curso</option>
                        @endif
                        @foreach($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('course_id'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('course_id') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                           placeholder="{{ __('adminlte::adminlte.password') }}" required />
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @if ($errors->has('password'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password_confirmation" class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                           placeholder="{{ __('adminlte::adminlte.retype_password') }}" required />
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @if ($errors->has('password_confirmation'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary btn-block btn-flat">
                    {{ __('adminlte::adminlte.register') }}
                </button>
            </form>
            <p class="mt-2 mb-1">
                <a href="{{ url(config('adminlte.login_url', 'login')) }}">
                    {{ __('adminlte::adminlte.i_already_have_a_membership') }}
                </a>
            </p>
        </div>
        <!-- /.form-box -->
    </div><!-- /.register-box -->
@stop

@section('adminlte_js')
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    @stack('js')
    @yield('js')
@stop
