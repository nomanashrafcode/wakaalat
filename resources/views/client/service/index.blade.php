@extends('layouts.client.layout')
@section('title')
<title>{{ $title_meta->service_title }}</title>
@endsection
@section('meta')
<meta name="description" content="{{ $title_meta->service_meta_description }}">
@endsection
@section('client-content')

<!--Banner Start-->
<div class="banner-area flex" style="background-image:url({{ $banner->service ? url($banner->service) : '' }});">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="banner-text">
                    <h1>{{ $navigation->service }}</h1>
                    <ul>
                        <li><a href="{{ url('/') }}">{{ $navigation->home }}</a></li>
                        <li><span>{{ $navigation->service }}</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Banner End-->


<div class="service-area bg-area">
    <div class="container">

        <div class="row service-row">
            <div class="col-md-12">
                <div class="service-coloum-area">
                    @foreach ($services as $service)
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
        {{ $services->links('client.paginator') }}
    </div>
</div>



@endsection
