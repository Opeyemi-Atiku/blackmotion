@extends('layout.app')
@section('content')


<section class="row page_cover">
    <div class="container">
        <div class="row m0">
            <h1>Discussions page</h1>
            <ol class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li class="active">Discussion details</li>
            </ol>
        </div>
    </div>
</section>

<section class="row">
    <ul class="nav nav-justified ribbon">
        <li><a href="#"></a></li>
        <li><a href="#"></a></li>
        <li><a href="#"></a></li>
        <li><a href="#"></a></li>
        <li><a href="#"></a></li>
        <li><a href="#"></a></li>
    </ul>
</section>
<!--Ribbon-->

<section class="row post_page_sidebar post_page_sidebar1">
    <div class="container">
        <div class="row">
            <div class="col-sm-9 post_page_uploads">
                <div class="author_details post_details row m0">
                    @if(!empty($question[0]->link))
                    @if(!$question[0]->type == 'youtube')
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="{{ $question[0]->link }}"></iframe>
                    </div>
                    @else
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe src="{{ $question[0]->link }}" allowfullscreen></iframe>

                    </div>
                    @endif
                    @endif
                    <div class="row post_title_n_view">
                        <h2 class="col-sm-8 post_title">{{ $question[0]->category }}</h2>
                    </div>
                    <div class="media bio_section">
                        <div class="media-left about_social">
                            <div class="row m0 section_row author_section widget widget_recommended_to_follow">
                                <div class="media">
                                    <div class="media-left"><a href="/user/{{ $question[0]->user->id }}"><img src="/profile_pictures/{{ $question[0]->user->profile_picture }}" alt="" class="circle"></a></div>
                                    <div class="media-body media-middle">
                                        <a href="/user/{{ $question[0]->user->id }}">
                                            <h5>{{ $question[0]->user->name }}</h5>
                                        </a>

                                    </div>
                                </div>
                            </div>
                            <div class="row m0 about_section section_row single_video_info">
                                <dl class="dl-horizontal">
                                    <dt>Published:</dt>
                                    <dd>{{ $question[0]->created_at->diffforhumans() }}</dd>

                                    <dt>Category:</dt>
                                    <dd>{{ $question[0]->category }}</dd>

                                    <dt>Imported From:</dt>
                                    <dd>{{ $question[0]->type }}</dd>
                                </dl>
                            </div>
                        </div>
                        <div class="media-body author_desc_by_author">
                            <p>{{ $question[0]->question }}</p>

                        </div>
                    </div>
                </div>
                <div class="row m0 comments">
                    @if($question[0]->answer->count() > 0)
                        <h5 class="comment_count">{{ $question[0]->answer->count() }} {{ $question[0]->answer->count() > 1 ? 'Answers': 'Answer' }}:</h5>
                    @else
                        <h5 class="comment_count">No comment available</h5><br><br>
                    @endif

                    @foreach($question[0]->answer as $answer)
                    <div class="media comment">
                        <div class="media-left"><a href="/user/{{ $answer->user->id }}"><img src="/profile_pictures/{{ $answer->user->profile_picture }}" alt="" class="img-circle" width="80" height="80"></a></div>
                        <div class="media-body">
                            <div class="comment_header">
                                <h5>
                                    <a href="/user/{{ $answer->user->id }}" class="author_name">{{ $answer->user->name }}</a>
                                    <span class="time_ago">{{ $answer->created_at->diffforhumans() }}</span>
                                    @if(Auth::check())
                                        @if(Auth::user()->status == 'active')
                                            <button class="btn btn-primary" id="reply_link{{ $answer->id }}" onclick="reply('{{ $answer->id }}')">Reply</button>
                                        @endif
                                    @endif
                                </h5>
                            </div>

                            <div class="row">
                                <div class="col-md-8">
                                    <p>{{ $answer->answer }}</p>
                                </div>
                                <div class="col-md-4">
                                    @if(!empty($answer->link) AND strpos($answer->link, 'https') !== false)
                                        <iframe style="width: 100%;" src="{{ $answer->link }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    @endif
                                </div>
                            </div>





                            <br>
                            <div id="reply_form{{ $answer->id }}" class="hidden">
                                <form action="/reply" method="post">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="answer_id" value="{{ $answer->id }}">
                                    <input type="hidden" name="question_id" value="{{ $question[0]->id }}">
                                    <textarea name="reply" class="form-control"></textarea><br>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>

                            </div>

                            @foreach($answer->reply as $reply)
                            <div class="media comment comment_reply">
                                <div class="media-left"><a href="/user/{{ $reply->user->id }}"><img src="/profile_pictures/{{ $reply->user->profile_picture }}" width="80" height="80" alt="" class="img-circle"></a></div>
                                <div class="media-body">
                                    <div class="comment_header">
                                        <h5>
                                            <a href="/user/{{ $reply->user->id }}" class="author_name">{{ $reply->user->name }}</a>
                                            <span class="time_ago">{{ $reply->created_at->diffforhumans() }}</span>
                                        </h5>
                                    </div>
                                    <p>{{ $reply->reply }}</p>
                                </div>
                            </div>
                            <!--Comment Reply-->
                            @endforeach
                        </div>
                    </div>
                    <!--Comment-->
                    @endforeach
                </div>
                @if(Auth::check())
                @if(Auth::user()->status == 'active')
                <form action="/answer" method="post" class="row m0 comment_form">
                    {{ csrf_field() }}
                    <input type="hidden" name="question_id" value="{{ $question[0]->id }}">
                    <h5>post your comment:</h5>
                    <textarea class="form-control" name="answer"></textarea>

                    <button class="btn btn-primary btn-xs" id="addVideo" type="button">Add Video</button> <small>(optional)</small><br><br>

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

                    <input type="submit" value="Submit Comment" class="btn btn-primary">
                    <br><br>
                </form>
                @elseif(Auth::user()->status == 'suspended')
                <h4 style="color: red;">You cannot contribute to this discussion because your account has been suspended, <a href="/contact-us">contact us now</a></h4>
                <br>
                @else
                <h4 style="color: red;">You cannot contribute to this discussion because your account has been blocked, <a href="/contact-us">contact us now</a></h4>
                <br>
                @endif

                @else
                <h4 style="color: green;"><a href="/login">Sign In</a> to join this discussion</h4><br>
                @endif
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
                </script>

                @endsection
            </div>

            <div class="col-sm-3 sidebar sidebar2">
                <div class="row m0 sidebar_row_inner">


                    <!--More From the Author-->
                    <div class="row m0 widget widget_popular_videos">
                        <h5 class="widget_title">more from <a href="/user/{{ $question[0]->user->id }}">{{ $question[0]->user->name }}</a></h5>
                        <div class="row m0 inner">
                            @foreach($more as $question)
                            <div class="media">
                                @if(!empty($question->link))
                                    <div class="media-left">
                                        <a href="/question/{{ $question->id }}">
                                            <!-- <img src="/images/video.png" alt=""> -->

                                            <iframe style="width: 100%;" src="{{ $question->link }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

                                        </a>
                                    </div>
                                @endif
                                <div class="media-body">
                                    <a href="/question/{{ $question->id }}">
                                        <h5>{{ substr($question->question, 0, 34) }}...</h5>
                                    </a>
                                    <div class="row m0 meta_info posted">{{ $question->created_at->diffforhumans() }}</div>
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<!--Uploads-->

<section class="row">
    <ul class="nav nav-justified ribbon">
        <li><a href="#"></a></li>
        <li><a href="#"></a></li>
        <li><a href="#"></a></li>
        <li><a href="#"></a></li>
        <li><a href="#"></a></li>
        <li><a href="#"></a></li>
    </ul>
</section>
<!--Ribbon-->

@include('includes.footer')

@endsection