@extends('layout.app')
@section('content')
<section class="row page_cover">
    <div class="container">
        <div class="row m0">
            <h1>Discussions</h1>
            <ol class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li class="active">discussions</li>
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
    <div class="container">
        <div class="row title_row">
            <h3>Discussions</h3>
        </div>
        <div class="row media-grid content_video_posts">
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
        <div class="row">
            {{ $questions->links() }}
        </div>

    </div>
</section>
<!--Recent Upload-->



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