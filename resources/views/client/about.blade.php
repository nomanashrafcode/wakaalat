@extends('layouts.client.layout')
@section('title')
<title>{{ $title_meta->aboutus_title }}</title>
@endsection
@section('meta')
<meta name="description" content="{{ $title_meta->aboutus_meta_description }}">
@endsection
@section('client-content')

<!--Banner Start-->
<div class="banner-area flex" style="background-image:url({{ $banner->about_us ? url($banner->about_us) : '' }});">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="banner-text">
                    <h1>{{ $navigation->about_us }}</h1>
                    <ul>
                        <li><a href="{{ url('/') }}">{{ $navigation->home }}</a></li>
                        <li><span>{{ $navigation->about_us }}</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Banner End-->


<!--About Us Start-->
<div class="about-style1 pt_50 pb_110">
    <div class="container">
        @if ($about_count != 0)
        <div class="row">
            <div class="col-lg-7">
                <div class="about1-text sm_pr_0 pr_150 mt_30">
                   {!! clean($about->about_description) !!}
                </div>
            </div>
            <div class="col-lg-5">
                <div class="about1-bgimg mt_30" style="background-image:url({{ $banner->about_us_bg ? url($about->background_image) : '' }});">
                    <div class="about1-inner">
                        <img src="{{url ($about->about_image) }}" alt="">
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
<!--About Us End-->


@if ($about_count != 0)
<!--Mission Start-->
<div class="mission-area bg-area pt_40 pb_90">
    <div class="container">
        <div class="row">
            <div class="col-md-6 pt_30">
                <div class="mission-img">
                    <img src="{{ url($about->mission_image) }}" alt="">
                </div>
            </div>
            <div class="col-md-6 pt_30">
                <div class="mission-text">
                    {!! clean($about->mission_description) !!}
                </div>
            </div>
        </div>
        <div class="row mt_40">
            <div class="col-md-6 pt_30">
                <div class="mission-text">
                    {!! clean($about->vision_description) !!}
                </div>
            </div>
            <div class="col-md-6 pt_30">
                <div class="mission-img vision-img">
                    <img src="{{ url($about->vision_image) }}" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<!--Mission End-->
@endif
<!--Counter Start-->
<div class="counter-page pt_40 pb_70" style="background-image: url({{ $banner->overview ? url($banner->overview) : '' }})">
    <div class="container">
        <div class="row">
            @foreach ($overviews as $overview)
            <div class="col-lg-3 col-6 mt_30 wow fadeInDown" data-wow-delay="0.2s">
                <div class="counter-item">
                    <div class="counter-icon">
                        <i class="{{ $overview->icon }}"></i>
                    </div>
                    <h2 class="counter">{{ $overview->qty }}</h2>
                    <h4>{{ $overview->name }}</h4>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!--Counter End-->
@php
    $work_section=App\HomeSection::where('section_type',2)->first();
@endphp
<!--Feature Start-->
<div class="about-area">
    <div class="container">
        <div class="row ov_hd">
            <div class="col-md-12 wow fadeInDown">
                <div class="main-headline">
                    <h1><span>{{ ucfirst($work_section->first_header) }}</span> {{ ucfirst($work_section->second_header) }}</h1>
                    <p>{{ $work_section->description }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="coustom-container">
        <div class="row ov_hd">
            <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.2s">
                <div class="about-skey mt_50">
                    <div class="about-img">
                        <img src="{{ url($work->image) }}" alt="">
                        <div class="video-section video-section-home">
                            <a class="video-button mgVideo" href="{{ $work->video }}"><span></span></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.2s">
                <div class="feature-section-text mt_50">
                    <h2>{{ $work->title }}</h2>
                    <p>{{ $work->description }}</p>
                    <div class="feature-accordion" id="accordion">
                        @foreach ($workFaqs as $faqIndex => $faq)
                        <div class="faq-item card">
                            <div class="faq-header" id="heading1-{{ $faq->id }}">
                                <button class="faq-button {{ $faqIndex != 0 ? 'collapsed':'' }}" data-toggle="collapse" data-target="#collapse1-{{ $faq->id }}" aria-expanded="true" aria-controls="collapse1-{{ $faq->id }}">{{ $faq->question }}</button>
                            </div>

                            <div id="collapse1-{{ $faq->id }}" class="collapse {{ $faqIndex == 0 ? 'show':'' }}" aria-labelledby="heading1-{{ $faq->id }}" data-parent="#accordion">
                                <div class="faq-body">
                                   {!! clean($faq->answer) !!}
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Feature End-->

@endsection
