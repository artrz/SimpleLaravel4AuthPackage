@extends('auth::base')

@section('main')
{{ Form::open() }}
    <div class="title"><div>
        Register
    </div></div>

    <div class="control-group">
        <div class="label">
            {{ Form::label('email', 'Email') }}
        </div>
        <div class="field">
            {{ Form::text('email') }}
        </div>
    </div>

    <div class="control-group">
        <div class="label">
            {{ Form::label('password', 'Password') }}
        </div>
        <div class="field">
            {{ Form::password('password') }}
        </div>
    </div>

    <div class="control-group">
        <div class="label">
            {{ Form::label('password_r', 'Repeat pwd') }}
        </div>
        <div class="field">
            {{ Form::password('password_r') }}
        </div>
    </div>

    <div class="form-actions">
        <a href="{{ URL::route('user_login_show') }}" class="btn">Sign in</a>
        &nbsp;
        {{ Form::submit('Register', array('class' => 'btn')) }}
    </div>
{{ Form::close() }}
@stop
