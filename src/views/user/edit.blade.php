@extends('auth::base')

@section('main')
<?php
    function parseDate($date)
    {
        $dateTime = DateTime::createFromFormat('Y-m-d H:i:s', $date);
        return $dateTime->format('D d, M Y, H:i');
    }
?>
{{ Form::open() }}
    <div class="title"><div>
        Edit
    </div></div>

    <div class="control-group">
        <div class="label">
            {{ Form::label('login', 'Login') }}
        </div>
        <div class="field"><div>
            {{ Sentry::getUser()->getLogin() }}
        </div></div>
    </div>

    <div class="control-group">
        <div class="label">
            {{ Form::label('firs_name', 'first name') }}
        </div>
        <div class="field">
            {{ Form::text('first_name', Sentry::getUser()['attributes']['first_name']) }}
        </div>
    </div>

    <div class="control-group">
        <div class="label">
            {{ Form::label('last_name', 'last name') }}
        </div>
        <div class="field">
            {{ Form::text('last_name', Sentry::getUser()['attributes']['last_name']) }}
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
        <a href="{{ URL::previous() }}" class="btn">Cancel</a>
        &nbsp;
        {{ Form::submit('Update', array('class' => 'btn')) }}
        <p>Registered at: {{ parseDate(Sentry::getUser()['attributes']['created_at']) }}</p>
        <p>Last login: {{ parseDate(Sentry::getUser()['attributes']['last_login']) }}</p>
        <p><a href="{{ URL::route('user_logout') }}" class="btn">Sign out</a></p>
        <br>
        <p><a href="{{ URL::route('user_delete') }}" class="btn">Delete account</a></p>
    </div>
{{ Form::close() }}
@stop
