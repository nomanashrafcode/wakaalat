@extends('layouts.client.layout')
@section('title')
<title>{{ $title_meta->blog_title }}</title>
@endsection
@section('meta')
<meta name="description" content="{{ $title_meta->blog_meta_description }}">
@endsection
@section('client-content')


<!--Banner Start-->
<div class="banner-area flex" style="background-image:url({{ $banner->blog ? url($banner->blog) : '' }});">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="banner-text">
                    <h1>{{ $navigation->blog }}</h1>
                    <ul>
                        <li><a href="{{ url('/') }}">{{ $navigation->home }}</a></li>
                        <li><span>{{ $navigation->blog }}</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Banner End-->

<!--Blog Start-->
<div class="blog-page pt_40 pb_90">
    <div class="container">
        <div class="row">
            @foreach ($blogs as $blog)
            <div class="col-lg-4 col-sm-6">
                <div class="blog-item">
                    <div class="blog-image">
                        <img src="{{ url($blog->thumbnail_image) }}" alt="">
                    </div>
                    <div class="blog-author">
                        <span><i class="fas fa-user"></i> {{ $website_lang->where('lang_key','admin')->first()->custom_lang }}</span>
                        <span><i class="far fa-calendar-alt"></i> {{ date('d F, Y', strtotime($blog->created_at->format('Y-m-d'))) }}</span>
                    </div>
                    <div class="blog-text">
                        <h3><a href="{{ url('blog-details/'.$blog->slug) }}">{{ $blog->title }}</a></h3>
                        <p>
                            {{ $blog->sort_description }}

                        </p>


                        @if ($isRtl=='RTL')
                            <a class="sm_btn" href="{{ url('blog-details/'.$blog->slug) }}">{{ $website_lang->where('lang_key','learn_more')->first()->custom_lang }} ←</a>
                            @else
                            <a class="sm_btn" href="{{ url('blog-details/'.$blog->slug) }}">{{ $website_lang->where('lang_key','learn_more')->first()->custom_lang }} →</a>
                            @endif

                    </div>
                </div>
            </div>
            @endforeach

        </div>
        <!--Pagination Start-->
        {{ $blogs->links('client.paginator') }}
        <!--Pagination End-->
    </div>
</div>
<!--Blog End-->



@endsection
