@extends('layouts.client.layout')
@section('title')
<title>{{ $page->seo_title }}</title>
@endsection
@section('meta')
<meta name="description" content="{{ $page->seo_description }}">
@endsection
@section('client-content')

<!--Banner Start-->
<div class="banner-area flex" style="background-image:url({{ $banner->custom_page ? url($banner->custom_page) : '' }});">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="banner-text">
                    <h1>{{ $page->page_name }}</h1>
                    <ul>
                        <li><a href="{{ url('/') }}">{{ $navigation->home }}</a></li>
                        <li><span>{{ $page->page_name }}</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Banner End-->


<div class="about-style1 pt_50 pb_50">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                {!! clean($page->description) !!}
            </div>
        </div>
    </div>
</div>



@endsection
