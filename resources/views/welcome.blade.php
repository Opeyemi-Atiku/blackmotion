@extends('layout.app') @section('content')

<section class="row upload_media">
    <div class="container">
        <div class="row col-md-6 col-md-offset-3" style="text-align: center;">
            <h2>Welcome to Blackmotion</h2>
            <h3>Share your ideas and thoughts online easily</h3>
            <div class="upload_media_row col-md-12" style="height: 260px !important; text-align: center;">
                <form action="#" id="upload_media" class="videos_from" style="height: 0px;">
                    <div class="inner row m0" style="text-align: center;">
                        <h2 style="color: white;">Sync Videos From</h2>
                        <a href="#"><img src="images/btn/youtube.png" alt=""></a>
                        <a class="vimeo" href="#"><img src="images/btn/vimeo.png" alt=""></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!--Upload Form-->



<section class="row">
    <ul class="nav nav-justified ribbon">
        <li>
            <a href="#"></a>
        </li>
        <li>
            <a href="#"></a>
        </li>
        <li>
            <a href="#"></a>
        </li>
        <li>
            <a href="#"></a>
        </li>
        <li>
            <a href="#"></a>
        </li>
        <li>
            <a href="#"></a>
        </li>
    </ul>
</section>
<!--Ribbon-->

<section class="row search_filter">
    <div class="container">
        <div class="row m0">
            <!--Category Filter-->
            <div class="btn-group category_filter fleft">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="filter-option pull-left">All Category</span>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    @include('includes.categories')
                </ul>
            </div>

            <form action="/search" method="post" role="search" class="search_form fright">
                {{ csrf_field() }}
                <div class="input-group">
                    @include('includes.search')
                    <span class="input-group-addon"><button type="submit"><img src="images/icons/search.png" alt=""></button></span>
                </div>
            </form>
        </div>
    </div>
</section>

<section class="row recent_uploads">
    <div class="container-fluid">
        <div class="row title_row">
            <h3>recent Discussions</h3>
        </div>
        <div class="row media-grid content_video_posts">
            <div class="col-md-12">


                @if($questions->count() > 0) @foreach($questions as $question)
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

                            <p style="font-size: 16px;">{{ substr($question->question, 0, 30) }}...</p>
                            <div class="fleft date">Published: {{ $question->created_at->diffforhumans() }}</div>

                        </div>
                    </div>
                </article>
                @endforeach @else
                <h3>No Discussions available</h3>
                @endif

            </div>
            <!-- <div class="col-md-3">
                <div class="col-md-12 video_post advertise_betweeen_uploads">
                    <div class="inner row m0">
                        <h3>Advertise<br>Here</h3>
                    </div>
                </div>
            </div> -->

            <div class="row m0">
                <div class="clearfix"></div>
                <a href="#" onclick="window.location.href='/questions'" class="load_more_videos">More Discussions</a>
            </div>
        </div>


    </div>
</section>
<!--Recent Upload-->
<div class="row">
    <!-- <div class="col-md-3">
        <div class="col-md-12 video_post advertise_betweeen_uploads">
            <div class="inner row m0">
                <h3>Advertise<br>Here</h3>
            </div>
        </div>
    </div> -->
    <div class="col-md-offset-3 col-md-6" style="text-align: center;">
        <img src="/images/about.jpeg" alt="" width="80%" height="40%">
        <h1><u>About Us</u></h1>
        <h4>Blackmotion Is a video sharing forum that facilitates <br> discussions and interactions amongst the black communities. <br> It allows the community to share their thoughts on matters <br> concerning their environment and the world.</h4>
    </div>
    <!-- <div class="col-md-3">
        <div class="col-md-12 video_post advertise_betweeen_uploads">
            <div class="inner row m0">
                <h3>Advertise<br>Here</h3>
            </div>
        </div>
    </div> -->
</div>





<section class="row">
    <ul class="nav nav-justified ribbon">
        <li>
            <a href="#"></a>
        </li>
        <li>
            <a href="#"></a>
        </li>
        <li>
            <a href="#"></a>
        </li>
        <li>
            <a href="#"></a>
        </li>
        <li>
            <a href="#"></a>
        </li>
        <li>
            <a href="#"></a>
        </li>
    </ul>
</section>
<!--Ribbon-->

@include('includes.footer')

<!-- Preloader -->
<div id="preloader">
    <div id="status">&nbsp;</div>
</div>

@endsection