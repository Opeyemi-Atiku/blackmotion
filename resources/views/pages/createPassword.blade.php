
@extends('layout.app')

@section('content')
    <form class="container-fluid login_form auth_form" action="/create-password" method="post" role="form">
        <div class="form-inner row">
            <div class="login_options row m0">
                <div class="options_header row m0">
                    <a href="#"><img src="images/logo.png" alt="" height="50" width="60"></a>
                    
                </div>
            </div>
            <div class="form-header row m0">
                <h4>Create your password</h4>
            </div>
            <div class="form-body row m0">
                <form class="form-horizontal" method="POST" action="/create-password">
                    {{ csrf_field() }}
                    <input type="password" required name="password" class="form-control form-group{{ $errors->has('password') ? ' has-error' : '' }}" placeholder="Enter Password">

                    <input type="password" required name="r_password" class="form-control form-group{{ $errors->has('r_password') ? ' has-error' : '' }}" placeholder="Re=enter Password">
                    
                    
                    

                    
                    <input type="submit" value="Create Password" class="btn btn-default form-control">
                </form>
            </div>
            
        </div>
    </form>
@endsection