<div class="auth-user-box">
    @if (!Sentry::check())
    <a class="brand" href="{{ URL::route('user_login_show') }}">Sign in</a>
    @else
    <a href="{{ URL::route('user_edit_show') }}">{{ Sentry::getUSer()->getLogin() }}</a> / <a href="{{ URL::route('user_logout') }}">Sign out</a>
    @endif
</div>
