@extends('layouts.client.layout')
@section('title')
<title>{{ $title_meta->faq_title }}</title>
@endsection
@section('meta')
<meta name="description" content="{{ $title_meta->faq_meta_description }}">
@endsection
@section('client-content')

<!--Banner Start-->
<div class="banner-area flex" style="background-image:url({{ $banner->faq ? url($banner->faq) : '' }});">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="banner-text">
                    <h1>{{ $navigation->faq }}</h1>
                    <ul>
                        <li><a href="{{ url('/') }}">{{ $navigation->home }}</a></li>
                        <li><span>{{ $navigation->faq }}</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Banner End-->

<!--Faq Start-->
<div class="faq-area pt_20 pb_70">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="faq-service feature-section-text mt_50">
                    <div class="feature-accordion" id="accordion">
                        @foreach ($faqCategories as $index => $category)
                            @if ($category->faqs->count()!=0)
                                <div class="faq-single-item"><h2>{{ $category->name }}</h2>
                                @foreach ($category->faqs as $faq)
                                    <div class="faq-item card">
                                        <div class="faq-header" id="heading->{{ $faq->id }}">
                                            <button class="faq-button collapsed" data-toggle="collapse" data-target="#collapse-{{ $faq->id }}" aria-expanded="true" aria-controls="collapse-{{ $faq->id }}">{{ $faq->question }}</button>
                                        </div>

                                        <div id="collapse-{{ $faq->id }}" class="collapse" aria-labelledby="heading->{{ $faq->id }}" data-parent="#accordion">
                                            <div class="faq-body">
                                                {!! clean($faq->answer) !!}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                </div>
                            @endif

                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Faq End-->



@endsection
