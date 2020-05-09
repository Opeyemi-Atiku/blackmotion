@extends('layout.app')
@section('content')
<section class="row page_cover">
    <div class="container">
        <div class="row m0">
            <h1>{{ $user[0]->name }}</h1>
            <ol class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li class="active">Profile Page</li>
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
            <div class="col-sm-8 post_page_uploads">
                <div class="author_details row m0">
                    <div class="author_cover row m0">
                        <img src="/images/author/cover.jpg" alt="">
                    </div>
                    <div class="row">
                        <div class="col-sm-6 author_photo_name">
                            <img src="/profile_pictures/{{ $user[0]->profile_picture }}" alt="" class="img-thumbnail img-circle">
                            <h3>{{ $user[0]->name }}</h3>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-sm-4 sidebar sidebar2">
                <div class="row m0 sidebar_row_inner">
                    
                    <h1>{{ $user[0]->name }}</h1>
                    <table class="table" style="font-size: 17px;">

                        <tr>
                            <td>Join Date</td>
                            <td>{{ $user[0]->created_at->format("M d, Y") }}</td>
                        </tr>
                        <tr>
                            <td>Total Discussions</td>
                            <td>{{ $questions->count() }}</td>
                        </tr>

                    </table>





                </div>
            </div>


        </div>
        <div class="row">
            <div class="row title_row">
                <h3>Discussions By {{ $user[0]->name }}</h3>
            </div>
            <div class="row">
                @if($questions->count() > 0)
                @foreach($questions as $question)
                <article class="col-sm-3 video_post postType3" style="cursor: pointer;" onclick="go('/question/{{ $question->id }}')">
                    <div class="inner row m0">
                        <div class="row screencast m0">
                            @if(!empty($question->link))
                            <iframe style="width: 100%;" src="{{ $question->link }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> @else
                            <!-- <img src="/images/video.png" alt="" class="cast img-responsive"> -->
                            @endif


                        </div>
                        <div class="row m0 col-md-12 post_data">
                            <div class="category"><img src="/images/icons/catagory.png" alt="">{{ $question->category }}</div>

                            <p style="font-size: 16px;">{{ substr($question->question, 0, 12) }}...</p>
                            <div class="fleft date">Published: {{ $question->created_at->diffforhumans() }}</div>

                        </div>
                    </div>
                </article>
                @endforeach
                @else
                <h3>No Discussion available</h3>
                @endif

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
@endsection