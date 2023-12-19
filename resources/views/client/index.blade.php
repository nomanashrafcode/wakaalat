@extends('layouts.client.layout')
@section('title')
<title>{{ $title_meta->home_title }}</title>
@endsection
@section('meta')
<meta name="description" content="{{ $title_meta->home_meta_description }}">
@endsection
@section('client-content')

<!--Slider Start-->
<div class="slider" id="main-slider">

    <div class="doc-search-item">
        @php
            $sliderContent=App\Setting::first();
        @endphp
        <div class="d-flex align-items-center h_100_p">
            <div class="v-mid-content">
                <div class="heading">
                    <h2>{{ $sliderContent->slider_heading }}</h2>
                    <p>{{ $sliderContent->slider_description }}</p>
                </div>
                <div class="doc-search-section">
                    <form action="{{ url('search-lawyer') }}">
                    <div class="box">
                        <select name="location" class="form-control select2">
                            <option value="">{{ $website_lang->where('lang_key','select_location')->first()->custom_lang }}</option>
                            @foreach ($locations as $location)
                            <option {{ @$location_id==$location->id?'selected':'' }} value="{{ $location->id }}">{{ ucwords($location->location) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="box">
                        <select name="department" class="form-control select2">
                            <option value="">{{ $website_lang->where('lang_key','select_department')->first()->custom_lang }}</option>
                            @foreach ($departmentsForSearch as $department)
                            <option {{ @$department_id==$department->id?'selected':'' }} value="{{ $department->id }}">{{ ucwords($department->name) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="box">
                        <select name="lawyer" class="form-control select2">
                            <option value="">{{ $website_lang->where('lang_key','select_lawyer')->first()->custom_lang }}</option>
                            @foreach ($lawyersForSearch as $lawyer)
                            <option value="{{ $lawyer->id }}">{{ $lawyer->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="doc-search-button">
                        <button type="submit" class="btn btn-danger">{{ $website_lang->where('lang_key','search')->first()->custom_lang }}</button>
                    </div>
                </form>
                </div>

            </div>
        </div>




    </div>




    <div class="slide-carousel owl-carousel">
        @foreach ($sliders as $item)
        <div class="slider-item flex" style="background-image:url({{ url($item->image) }});">
            <div class="bg-slider"></div>
            <div class="container">
                <div class="row">

                </div>
            </div>
        </div>
        @endforeach


    </div>
</div>
<!--Slider End-->





@php
    $feature_section=$homesections->where('section_type',1)->first();
@endphp
<!--Why Us Start-->
@if ($feature_section->show_homepage==1)
<div class="why-us-area pt_30">
    <div class="container">
        <div class="row">
            @foreach ($features->take($feature_section->content_quantity) as $feature)
            <div class="col-lg-4 choose-col">
                <div class="choose-item flex" style="background-image: url({{ url($feature->background_image) }})">
                    <div class="choose-icon">
                        <i class="{{ $feature->logo }}"></i>
                    </div>
                    <div class="choose-text">
                        <h4>{{ $feature->title }}</h4>
                        <p>
                           {{ $feature->description }}
                        </p>
                    </div>
                </div>
            </div>

            @endforeach

        </div>
    </div>
</div>
<!--why Us End-->
@endif

@php
    $work_section=$homesections->where('section_type',2)->first();
@endphp
@if ($work_section->show_homepage==1)
<!--Feature Start-->
<div class="about-area">
    <div class="container">
        <div class="row ov_hd">
            <div class="col-md-12 wow fadeInDown">
                <div class="main-headline">
                    <h1><span>{{ ucfirst($work_section->first_header) }}</span> {{ ucfirst($work_section->second_header) }}</h1>
                    <p>"We work diligently to simplify legal processes, connecting you with experienced lawyers for swift consultations and efficient case management."</p>
                </div>
            </div>
        </div>
    </div>
    <div class="coustom-container">
        <div class="row ov_hd">
            <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.2s">
                <div class="about-skey mt_50">
                    <div class="about-img">
                        <img src="{{ $work->image ? url($work->image) : '' }}" alt="">
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
@endif

@php
$service_section=$homesections->where('section_type',3)->first();
@endphp
@if ($service_section->show_homepage==1)
<!--Service Start-->
<div class="service-area bg-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="main-headline">
                    <h1><span>{{ ucfirst($service_section->first_header) }}</span> {{ ucfirst($service_section->second_header) }}</h1>
                    <p>{{ $service_section->description }}</p>
                </div>
            </div>
        </div>
        <div class="row service-row">
            <div class="col-md-12">
                <div class="service-coloum-area">
                    @foreach ($services->take($service_section->content_quantity) as $service)
                    <div class="service-coloum">
                        <div class="service-item">
                            <i class="{{ $service->icon }}"></i>
                            <h3>{{ $service->header }}</h3>
                            <p>{{ $service->sort_description }}</p>

                            @if ($isRtl=='RTL')
                            <a href="{{ url('service-details/'.$service->slug) }}">{{ $website_lang->where('lang_key','learn_more')->first()->custom_lang }} ←</a>
                            @else
                            <a href="{{ url('service-details/'.$service->slug) }}">{{ $website_lang->where('lang_key','learn_more')->first()->custom_lang }} →</a>
                            @endif

                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="home-button ser-btn">
                    <a href="{{ url('service') }}">{{ $website_lang->where('lang_key','all_service')->first()->custom_lang }}</a>
                </div>
            </div>
        </div>
        <!--Counter Start-->

        <div class="counter-row row" style="background-image: url({{ $banner->overview ? url($banner->overview) : '' }})">
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
        <!--Counter End-->
    </div>
</div>
<!--Service End-->
@endif


@php
$department_section=$homesections->where('section_type',4)->first();
@endphp
@if ($department_section->show_homepage==1)
<!--Portfolio Start-->
<div class="case-study-home-page case-study-area ">
    <div class="container">
        <div class="row mb_25">
            <div class="col-md-12 wow fadeInDown" data-wow-delay="0.1s">
                <div class="main-headline">
                    <h1><span>{{ ucfirst($department_section->first_header) }}</span> {{ ucfirst($department_section->second_header) }}</h1>
                    <p>{{ $department_section->description }}</p>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($departments->take($department_section->content_quantity) as $department)
                    <div class="col-lg-4 col-md-6 mt_15">
                        <div class="case-item">
                            <div class="case-box">
                                <div class="case-image">
                                    <img src="{{ url($department->thumbnail_image) }}" alt="">
                                    <div class="overlay"><a href="{{ url('department-details/'.$department->slug) }}" class="btn-case">{{ $website_lang->where('lang_key','see_details')->first()->custom_lang }}</a>
                                    </div>
                                </div>
                                <div class="case-content">
                                    <h4><a href="{{ url('department-details/'.$department->slug) }}">{{ $department->name }}</a></h4>
                                </div>
                            </div>
                        </div>
                    </div>
            @endforeach
        </div>
        <div class="row mb_60">
            <div class="col-md-12">
                <div class="home-button">
                    <a href="{{ url('department') }}">{{ $website_lang->where('lang_key','all_department')->first()->custom_lang }}</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endif


@php
$patient_section=$homesections->where('section_type',5)->first();
@endphp
@if ($patient_section->show_homepage==1)
<!--Testimonial Start-->
<div class="testimonial-area {{ $department_section->show_homepage==0 ? 'mt_200':'' }}">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="main-headline">
                    <h1><span>{{ ucfirst($patient_section->first_header) }}</span> {{ ucfirst($patient_section->second_header) }}</h1>
                    <p>{{ $patient_section->description }}</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="testimonial-texarea mt_30">
                    <div class="owl-testimonial owl-carousel">
                        @foreach ($testimonials->take($patient_section->content_quantity) as $patient)
                        <div class="testimonial-item wow fadeIn" data-wow-delay="0.2s">
                            <p class="wow fadeInDown" data-wow-delay="0.2s">
                                {{ $patient->description }}
                            </p>
                            <div class="testi-info wow fadeInUp" data-wow-delay="0.2s">
                                <img src="{{ url($patient->image) }}" alt="">
                                <h4>{{ $patient->name }}</h4>
                                <span>{{ $patient->designation }}</span>
                            </div>
                        </div>
                        @endforeach


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Testimonial End-->
@endif



@php
$lawyer_section=$homesections->where('section_type',6)->first();
@endphp
@if ($lawyer_section->show_homepage==1)
<!--Team Area Start-->
<div class="team-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="main-headline">
                    <h1><span>{{ ucfirst($lawyer_section->first_header) }}</span> {{ ucfirst($lawyer_section->second_header) }}</h1>
                    <p>{{ $lawyer_section->description }}</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="team-carousel owl-carousel">
                    @foreach ($lawyers->take($lawyer_section->content_quantity) as $lawyer)
                    <div class="team-item">
                        <div class="team-photo">
                            <img src="{{ url($lawyer->image) }}" alt="Team Photo">
                        </div>
                        <div class="team-text">
                            <a href="{{ url('lawyer-details/'.$lawyer->slug) }}">{{ $lawyer->name }}</a>
                            <p>{{ $lawyer->department->name }}</p>
                            <p><span><i class="fas fa-graduation-cap"></i> {{ $lawyer->designations }}</span></p>
                            <p><span><b><i class="fas fa-street-view"></i> {{ ucfirst($lawyer->location->location) }}</b></span></p>
                        </div>
                        <div class="team-social">
                            <ul>
                                @if ($lawyer->facebook)
                                <li><a href="{{ $lawyer->facebook }}"><i class="fab fa-facebook-f"></i></a></li>
                                @endif
                                @if ($lawyer->twitter)
                                <li><a href="{{ $lawyer->twitter }}"><i class="fab fa-twitter"></i></a></li>
                                @endif
                                @if ($lawyer->linkedin)
                                <li><a href="{{ $lawyer->linkedin }}"><i class="fab fa-linkedin"></i></a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    @endforeach


                </div>
            </div>
        </div>
    </div>
</div>
<!--Team Area End-->
@endif


@php
$blog_section=$homesections->where('section_type',7)->first();
@endphp
@if ($blog_count !=0)
@if ($blog_section->show_homepage==1)
<!--Blog-Area Start-->
<div class="blog-area bg_ecf1f8">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="main-headline">
                    <h1><span>{{ ucfirst($blog_section->first_header) }}</span> {{ ucfirst($blog_section->second_header) }}</h1>
                    <p>{{ $blog_section->description }}</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="blog-item first-blog">
                    <a href="{{ url($feature_blog->feature_image) }}" class="image-effect">
                        <div class="blog-image">
                            <img src="{{ url($feature_blog->feature_image) }}" alt="">
                        </div>
                    </a>
                    <div class="blog-text">
                        <div class="blog-author">
                            <span><i class="fas fa-user"></i> {{ $website_lang->where('lang_key','admin')->first()->custom_lang }}</span>
                            <span><i class="far fa-calendar-alt"></i> {{ $feature_blog->created_at->format('m-d-Y') }}</span>
                        </div>
                        <h3><a href="{{ url('blog-details/'.$feature_blog->slug) }}">{{ $feature_blog->title }}</a></h3>
                        <p>
                            {{ $feature_blog->sort_description }}
                        </p>

                        @if ($isRtl=='RTL')
                        <a class="sm_btn" href="{{ url('blog-details/'.$feature_blog->slug) }}">{{ $website_lang->where('lang_key','see_details')->first()->custom_lang }} ←</a>
                        @else
                            <a class="sm_btn" href="{{ url('blog-details/'.$feature_blog->slug) }}">{{ $website_lang->where('lang_key','see_details')->first()->custom_lang }} →</a>
                        @endif


                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="blog-carousel owl-carousel">
                    @php $i=0; @endphp
                    @foreach ($blogs->take($blog_section->content_quantity) as $blog)
                        @php $i++; @endphp
                        @if($i == 1)
                            @continue
                        @endif
                        <div class="blog-item effect-item">
                            <a href="#" class="image-effect">
                                <div class="blog-image">
                                    <img src="{{ $blog->thumbnail_image }}" alt="Blog Thumbnail Image">
                                </div>
                            </a>
                            <div class="blog-text">
                                <div class="blog-author">
                                    <span><i class="fas fa-user"></i> {{ $website_lang->where('lang_key','admin')->first()->custom_lang }}</span>
                                    <span><i class="far fa-calendar-alt"></i> {{ $blog->created_at->format('m-d-Y') }}</span>
                                </div>
                                <h3><a href="{{ url('blog-details/'.$blog->slug) }}">{{ $blog->title }}</a></h3>
                                <p>
                                    {{ $blog->sort_description }}
                                </p>

                                @if ($isRtl=='RTL')
                                <a class="sm_btn" href="{{ url('blog-details/'.$blog->slug) }}">{{ $website_lang->where('lang_key','see_details')->first()->custom_lang }} ←</a>
                                @else
                                <a class="sm_btn" href="{{ url('blog-details/'.$blog->slug) }}">{{ $website_lang->where('lang_key','see_details')->first()->custom_lang }} →</a>
                                @endif
                            </div>
                        </div>
                    @endforeach


                </div>
            </div>
        </div>
    </div>
</div>
<!--Blog-Area End-->
@endif
@endif
@endsection
