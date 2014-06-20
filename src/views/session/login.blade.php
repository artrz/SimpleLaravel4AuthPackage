@extends('auth::base')

@section('main')
    @if (!Sentry::check())
        {{ Form::open() }}
        <div class="title"><div>
            Sign in
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
            {{ Form::label('remember', 'remember') }}
            </div>
            <div class="field"><div>
                {{ Form::checkbox('remember') }}
            </div></div>
        </div>

        <div class="form-actions">
            <a href="{{ URL::route('user_register_show') }}" class="btn">Register</a>
            &nbsp;
            <input type="submit" class="btn" name="login" value="Sign in">
        </div>
        {{ Form::close() }}
    @else
        <div class="center-text">
            You already signed in as
            <br><br>
            {{ Sentry::getUSer()->getLogin() }}
            <br><br>
            <a href="{{ URL::route('user_edit_show') }}" class="btn">Edit</a>
            &nbsp;
            <a href="{{ URL::route('user_logout') }}" class="btn">Sign out</a>
        </div>
    @endif
@stop
