<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Userland</title>
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('packages/allegro/auth/style.css') }}" />
    </head>
    <body>
        @if(Session::has('error'))
            <p class="alert {{ Session::get('alert-class', 'alert-error') }}">{{ Session::get('error') }}</p>
        @endif
        @if(Session::has('notice'))
            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('notice') }}</p>
        @endif

        <div class="container">
            <div id="login-block">
                @yield('main')
            </div>
        </div>
    </body>
</html>