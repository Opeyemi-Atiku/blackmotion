@extends('layout.app')
@section('content')

    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3" style="margin-top: 40px;">
                    <form action="/contact" method="post">
                        {{ csrf_field() }}

                        <h1>Send us a message:</h1>

                        <div style="margin-bottom: 25px" id="link" class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input id="login-username" required type="text" class="form-control" name="name" value="" placeholder="Enter your name">
                        </div>

                        <div style="margin-bottom: 25px" id="link" class="input-group">
                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                            <input id="login-username" required type="text" class="form-control" name="email" value="" placeholder="Enter your email address">
                        </div>

                        <div style="margin-bottom: 25px" id="link" class="input-group">
                            <span class="input-group-addon"><i class="fa fa-paste"></i></span>
                            <input id="login-username" required type="text" class="form-control" name="subject" value="" placeholder="Give your message a subject">
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                            <textarea class="form-control" required name="message" placeholder="Type message here.."></textarea>
                            
                        </div>
                        <br> 

                        
                        <button type="submit" class="btn btn-primary">Send <i class="fa fa-send"></i></button>
                        <br><br>
                    </form>
                </div>
                    
            </div>
        </div>
    </section>


@endsection