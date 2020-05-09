@extends('layout.app')

@section('content')
<div class="row">


    <div class="col-lg-12 col-sm-12">
        <div class="card hovercard">
            <div class="card-background">
                <img class="card-bkimg" alt="" src="http://lorempixel.com/100/100/people/9/">
            </div>
            <div class="useravatar">
                <img alt="" src="/profile_pictures/{{ Auth::user()->profile_picture }}">
            </div>
            <div class="card-info"> <span class="card-title">{{ Auth::user()->name }}</span>

            </div>
        </div>
        <div class="btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="...">
            <div class="btn-group" role="group">
                <button type="button" id="stars" class="btn btn-primary" href="#tab1" data-toggle="tab"><span class="fa fa-building" aria-hidden="true"></span>
                    <div class="hidden-xs">Discussions</div>
                </button>
            </div>
            <div class="btn-group" role="group">
                <button type="button" id="favorites" class="btn btn-default" href="#tab2" data-toggle="tab"><span class="fa fa-question-circle" aria-hidden="true"></span>
                    <div class="hidden-xs">Start a new Discussion</div>
                </button>
            </div>
            <div class="btn-group" role="group">
                <button type="button" id="following" class="btn btn-default" href="#tab3" data-toggle="tab"><span class="fa fa-edit" aria-hidden="true"></span>
                    <div class="hidden-xs">Edit Profile</div>
                </button>
            </div>
        </div>

        <div class="well" style="background: white !important; border-color: white !important;">
            <div class="tab-content">
                <div class="tab-pane fade in active" id="tab1">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1" style="box-shadow: 0px 5px 11.64px 0.36px rgba(0, 0, 0, 0.13);">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Discussion</th>
                                        <th>Category</th>
                                        <th>Link</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($questions->count() > 0)

                                    @for($i=0; $i<$questions->count(); $i++)
                                        <tr>
                                            <td>{{ $i+1 }}</td>
                                            <td>{{ $questions[$i]->question }}</td>
                                            <td>{{ $questions[$i]->category }}</td>
                                            <td>{{ $questions[$i]->link }}</td>
                                            <td>
                                                <button class="btn btn-danger" onclick="deleteQuestion('{{ $questions[$i]->id }}')">Delete</button>
                                                <button class="btn btn-info" data-toggle="modal" data-target="#flipFlop" onclick="edit('{{ $questions[$i]}}')">Edit</button>
                                            </td>
                                        </tr>
                                        @endfor
                                        @else
                                        <tr>
                                            <td colspan="5" style="text-align: center;">You have no discussions</td>
                                        </tr>
                                        @endif
                                </tbody>
                            </table>
                            {{ $questions->links() }}
                        </div>


                    </div>
                </div>
                <div class="tab-pane fade in" id="tab2">
                    <div class="row">
                        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                            <div class="panel panel-info" style="box-shadow: 0px 5px 11.64px 0.36px rgba(0, 0, 0, 0.13);">
                                <div class="panel-heading">
                                    <div class="panel-title">Start a new discussion</div>

                                </div>

                                <div style="padding-top:30px" class="panel-body">
                                    @if(Auth::user()->status == 'active')
                                    <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>

                                    <form id="loginform" method="post" action="/create-question" class="form-horizontal" role="form">
                                        {{ csrf_field() }}
                                        <div style="margin-bottom: 25px" class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                                            <textarea type="text" class="form-control" required name="question" value="" placeholder="Type discussion here"></textarea>
                                        </div>

                                        <div style="margin-bottom: 25px" class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-bars"></i></span>
                                            <select type="text" required class="form-control" name="category" value="">
                                                <option value="ados">ADOS</option>
                                                <option value="africa">Africa</option>
                                                <option value="arts and expression">Arts and Expression</option>
                                                <option value="beauty">Beauty</option>
                                                <option value="business">Business</option>

                                                <option value="dating and relationship">Dating and Relationship</option>
                                                <option value="education">Education</option>
                                                <option value="entrepreneurship">Entrepreneurship</option>
                                                <option value="sports">Fashion</option>
                                                <option value="lifestyles">Lifestyles</option>
                                                <option value="marriage">Marriage</option>
                                                <option value="music">Music</option>

                                                <option value="parenting">Parenting</option>
                                                <option value="politics">Politics</option>
                                                <option value="sports">Sports</option>
                                                <option value="travels">Travels</option>
                                                <option value="work">Work</option>
                                                <option value="others">Others</option>
                                            </select>
                                        </div>

                                        <button class="btn btn-primary" id="addVideo" type="button">Add Video</button> <small>(optional)</small><br><br>

                                        <div style="margin-bottom: 25px" id="type" class="input-group hidden">
                                            <span class="input-group-addon"><i class="fa fa-video"></i></span>
                                            <select type="text" class="form-control" name="type" id="source" value="">
                                                <option value="">Choose video source</option>
                                                <option value="youtube">YouTube</option>
                                                <option value="vimeo">Vimeo</option>
                                            </select>
                                        </div>
                                        <p id="message"></p>
                                        <div style="margin-bottom: 25px" id="link" class="input-group hidden">
                                            <span class="input-group-addon"><i class="fa fa-video"></i></span>
                                            <input id="login-username" type="text" class="form-control" name="link" value="" placeholder="Paste embed code here">
                                        </div>




                                        <div style="margin-top:10px" class="form-group">
                                            <!-- Button -->

                                            <div class="col-sm-12 controls">
                                                <button id="btn-fblogin" class="btn btn-primary">Post Discussion</button>

                                            </div>
                                        </div>


                                    </form>
                                    @elseif(Auth::user()->status == 'suspended')
                                    <h4 style="color: red;">Your account has been suspended, <a href="/contact-us">contact us now</a></h4>
                                    @else
                                    <h4 style="color: red;">Your account has been blocked, <a href="/contact-us">contact us now</a></h4>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @section('js')
                <script>
                    $("#source").change(function() {
                        let data = $("#source").val();
                        if (data == "youtube") {
                            $("#message").text("Copy the embed code of desired video from youtube and paste it in the input field below.");
                        } else {
                            $("#message").text("Copy the embed code of desired video from vimeo and paste it in the input field below.");
                        }

                    });

                    $("#type3").change(function() {
                        let data = $("#type3").val();
                        if (data == "youtube") {
                            $("#message2").text("Copy the embed code of desired video from youtube and paste it in the input field below.");
                        } else {
                            $("#message2").text("Copy the embed code of desired video from vimeo and paste it in the input field below.");
                        }

                    });
                </script>

                @endsection
                <div class="tab-pane fade in" id="tab3">
                    <div class="row">
                        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                            <div class="panel panel-info" style="box-shadow: 0px 5px 11.64px 0.36px rgba(0, 0, 0, 0.13);">
                                <div class="panel-heading">
                                    <div class="panel-title">Edit Profile</div>

                                </div>

                                <div style="padding-top:30px" class="panel-body">

                                    <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>

                                    <form method="post" enctype="multipart/form-data" action="/edit-profile" class="form-horizontal" role="form">
                                        {{ csrf_field() }}
                                        <div style="margin-bottom: 25px" class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" placeholder="Type name here">
                                        </div>

                                        <div style="margin-bottom: 25px" class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                            <input type="text" class="form-control" required name="email" value="{{ Auth::user()->email }}" placeholder="Type email here">
                                        </div>


                                        <span>Change profile picture(optional)</span>
                                        <div style="margin-bottom: 25px" class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-image"></i></span>
                                            <input type="file" class="form-control" name="profile_picture">
                                        </div>





                                        <div style="margin-top:10px" class="form-group">
                                            <!-- Button -->

                                            <div class="col-sm-12 controls">
                                                <button id="btn-fblogin" class="btn btn-primary">Edit</button>

                                            </div>
                                        </div>


                                    </form>



                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


<!-- The modal -->
<div class="modal fade" id="flipFlop" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="modalLabel">Edit Discussion</h4>
            </div>
            <div class="modal-body">
                <form id="editForm" method="post" action="/edit-question" class="form-horizontal" role="form">
                    {{ csrf_field() }}
                    <input type="hidden" name="question_id" id="questionId">
                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <textarea type="text" class="form-control" name="question" id="question" value="" placeholder="Type question here"></textarea>
                    </div>

                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <select type="text" class="form-control" name="category" id="category" value="">
                            <option value="ados">ADOS</option>
                            <option value="africa">Africa</option>
                            <option value="arts and expression">Arts and Expression</option>
                            <option value="beauty">Beauty</option>
                            <option value="business">Business</option>

                            <option value="dating and relationship">Dating and Relationship</option>
                            <option value="education">Education</option>
                            <option value="entrepreneurship">Entrepreneurship</option>
                            <option value="sports">Fashion</option>
                            <option value="lifestyles">Lifestyles</option>
                            <option value="marriage">Marriage</option>
                            <option value="music">Music</option>

                            <option value="parenting">Parenting</option>
                            <option value="politics">Politics</option>
                            <option value="sports">Sports</option>
                            <option value="travels">Travels</option>
                            <option value="work">Work</option>
                            <option value="others">Others</option>
                        </select>
                    </div>

                    <button class="btn btn-primary" id="addVideo2" type="button">Add / Change Video</button> <small>(optional)</small><br><br>



                    <div style="margin-bottom: 25px" id="type2" class="input-group hidden">
                        <span class="input-group-addon"><i class="fa fa-video"></i></span>
                        <select type="text" class="form-control" name="type" id="type3" value="">
                            <option value="">Choose video source</option>
                            <option value="youtube">YouTube</option>
                            <option value="vimeo">Vimeo</option>
                        </select>
                    </div>
                    <p id="message2"></p>
                    <div style="margin-bottom: 25px" id="link2" class="input-group hidden">
                        <span class="input-group-addon"><i class="fa fa-video"></i></span>
                        <input type="text" class="form-control" id="link3" name="link" value="" placeholder="Paste video link">
                    </div>


                    



                    <div style="margin-top:10px" class="form-group">
                        <!-- Button -->

                        <div class="col-sm-12 controls">
                            <button class="btn btn-primary">Edit Discussion</button>

                        </div>
                    </div>


                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection