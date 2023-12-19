@extends('layouts.client.layout')
@section('title')
<title>Terms and Conditions</title>
@endsection
@section('client-content')


<!--Banner Start-->
<div class="banner-area flex" style="background-image:url({{ $banner->terms_and_condition ? url($banner->terms_and_condition) : '' }});">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="banner-text">
                    <h1>{{ $navigation->terms_and_condition }}</h1>
                    <ul>
                        <li><a href="{{ url('/') }}">{{ $navigation->home }}</a></li>
                        <li><span>{{ $navigation->terms_and_condition }}</span></li>
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
                @if ($condition_count !=0 )
                {!! clean($condition->terms_condition) !!}
                @endif

            </div>
        </div>
    </div>
</div>


@endsection
