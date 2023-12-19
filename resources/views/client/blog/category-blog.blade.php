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
                    <h1>{{ $category->name }}</h1>
                    <ul>
                        <li><a href="{{ url('/') }}">{{ $navigation->home }}</a></li>
                        <li><span>{{ $category->name }}</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Banner End-->

<div class="blog-page pt_40 pb_90">
    @if ($blogs->count()!=0)
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
                        <span><i class="far fa-calendar-alt"></i> {{ $blog->created_at->format('F-d-Y') }}</span>
                    </div>
                    <div class="blog-text">
                        <h3><a href="{{ url('blog-details/'.$blog->slug) }}">{{ $blog->title }}</a></h3>
                        <p>
                            {{ $blog->sort_description }}
                        </p>
                        <a class="sm_btn" href="{{ url('blog-details/'.$blog->slug) }}">{{ $website_lang->where('lang_key','learn_more')->first()->custom_lang }} →</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <!--Pagination Start-->
        {{ $blogs->links('client.paginator') }}
        <!--Pagination End-->
    </div>
    @else
        <div class="container">
            <h1 class="text-center text-danger display-4">{{ $website_lang->where('lang_key','blog_not_found')->first()->custom_lang }}</h1>
        </div>
    @endif

</div>

@endsection
