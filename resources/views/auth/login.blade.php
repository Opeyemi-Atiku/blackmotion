@extends('layout.app')

@section('content')
<form class="container-fluid login_form auth_form" action="#" method="post" role="form">
    <div class="form-inner row">
        <div class="login_options row m0">
            <div class="options_header row m0">
                <a href="#"><img src="images/logo.png" alt="" height="50" width="60"></a>
                
            </div>
        </div>
        <div class="form-header row m0">
            <h4>or Sign in using email address</h4>
        </div>
        <div class="form-body row m0">
            <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
                <input type="email" name="email" class="form-control form-group{{ $errors->has('email') ? ' has-error' : '' }}" placeholder="Email Address">
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong style="color: red;">{{ $errors->first('email') }}</strong>
                    </span>
                @endif
                
                <input type="password" name="password" class="form-control form-group{{ $errors->has('password') ? ' has-error' : '' }}" placeholder="Password">
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong style="color: red;">{{ $errors->first('password') }}</strong>
                    </span>
                @endif

                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me

                <input type="submit" value="Sign In" class="btn btn-default form-control">
            </form>
            <br>
            <br>
            <a href="/password/reset" style="font-size: 18px !important; margin: 20% !important;">Forgot your password?</a>
        </div>
        <div class="login_options row m0">
            <div class="options_header row m0">
                
                <h4>Sign in to {{ config('app.name') }} using social profiles or <a href="/register">create an account</a></h4>
            </div>
            <div class="row m0 login_with_social_media">
                <a href="/facebook"><img src="images/btn/facebook-login.png" alt=""></a>
            </div>
        </div>
    </div>
</form>
@endsection
