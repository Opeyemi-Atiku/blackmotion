@extends('layout.app')

@section('content')
   
    <form class="container-fluid signup_form auth_form" enctype="multipart/form-data" style="margin-top: -120px !important;" action="{{ route('register') }}" method="post" role="form">
        {{ csrf_field() }}
        <div class="form-inner row">
            <div class="form-header row m0">
                <a href="#"><img src="images/logo.png" alt="" width="60" height="50"></a>
                <h4>Sign up for {{ config('app.name')}} Account</h4>
            </div>
            
            <div class="form-body row m0">
                <input type="text" class="form-control" placeholder="Full Name" name="name" value="{{ old('name') }}" required autofocus>
                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong style="color: red;">{{ $errors->first('name') }}</strong>
                    </span>
                @endif

                <input type="email" class="form-control" placeholder="Email Address" name="email" value="{{ old('email') }}" required>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong style="color: red;">{{ $errors->first('email') }}</strong>
                    </span>
                @endif

                <!-- <input type="number" class="form-control" placeholder="Age" name="age" value="{{ old('age') }}" required>
                @if ($errors->has('age'))
                    <span class="help-block">
                        <strong style="color: red;">{{ $errors->first('age') }}</strong>
                    </span>
                @endif -->
                
                <input type="password" class="form-control" name="password" placeholder="Password">
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong style="color: red;">{{ $errors->first('password') }}</strong>
                    </span>
                @endif

                <input type="password" class="form-control"  name="password_confirmation" required placeholder="Re-enter Password">
                <br>
                <input type="file" class="filestyle" name="profile_picture" required data-buttonBefore="true" data-text="Choose Avatar" data-btnClass="btn-primary">

                <input type="submit" value="Create My Account" class="btn btn-default form-control">
            </div>
        </div>
        <br>
        <div class="login_options row m0" style="text-align: center;">
            <div class="options_header row m0">
                Already have an account? <h4><a href="/login">Sign In</a></h4>
                
            </div>
            
        </div>
    </form>

    
@endsection
