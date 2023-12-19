@extends('layouts.client.layout')
@section('title')
<title>{{ $title_meta->testimonial_title }}</title>
@endsection
@section('meta')
<meta name="description" content="{{ $title_meta->testimonial_meta_description }}">
@endsection
@section('client-content')

<!--Banner Start-->
<div class="banner-area flex" style="background-image:url({{ $banner->testimonial ? url($banner->testimonial) : url('patient/img/banner.png') }});">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="banner-text">
                    <h1>{{ $navigation->testimonial }}</h1>
                    <ul>
                        <li><a href="{{ url('/') }}">{{ $navigation->home }}</a></li>
                        <li><span>{{ $navigation->testimonial }}</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Banner End-->

<!--Testimonial Start-->
<div class="testimonial-page pt_40 pb_70">
    <div class="container">
        <div class="row">
            @foreach ($testimonials as $testimonial)
            <div class="col-lg-4 col-md-6 col-12">
                <div class="testimonial-item mt_30">
                    <p>
                        {{ $testimonial->description }}
                    </p>
                    <div class="testi-info">
                        <img src="{{ url($testimonial->image) }}" alt="">
                        <h4>{{ $testimonial->name }}</h4>
                        <span>{{ $testimonial->designation }}</span>
                    </div>
                    <div class="testi-link">
                        <a href="javascript:void;"></a>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
        {{ $testimonials->links('client.paginator') }}
    </div>
</div>
<!--Testimonial End-->




@endsection
