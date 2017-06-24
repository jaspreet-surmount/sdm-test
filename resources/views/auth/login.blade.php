@extends('master_layout')

@section('title')
	{{ \Lang::get('title.login_page') }} :: @parent
@stop

@section('main')

    <div class="col-md-12 margintop20">
        <div class="col-md-6 description hidden-xs hidden-sm">
            <h3>{{ Lang::get('auth.welcome') }}</h3>
            <p>
            {{ Lang::get('auth.login_title') }}
            </p>
        </div>
        <div class="col-md-6 login-form">
            {!! Form::open(['url'=>URL::to('auth/login'), 'class'=>'form form-horizontal', 'method'=>'post']) !!}

            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-user"></i></span>
                    {!! Form::text('email', Input::old('email'), ['class'=>'form-control', 'aria-describedby'=>'basic-addon1', 'placeholder'=>Lang::get('auth.email')]) !!}
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                    {!! Form::password('password', ['class'=>'form-control', 'placeholder' => Lang::get('auth.password')]) !!}
                </div>
            </div>
            <div class="form-group">
                <div class="pull-left">
                    <div class="checkbox">
                        <label for="remember">
                            {!! Form::checkbox('remember', '1', null, ['id' => 'remember']) !!}
                            {{ Lang::get('auth.remember') }}
                        </label>
                    </div>
                </div>
                <div class="pull-right">
                    <input type="submit" value="Login" class="btn btn-primary">
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('scripts')
@include('js-helper.student')
@stop
