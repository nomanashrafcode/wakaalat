@extends('layouts.client.layout')
@section('title')
<title>Privacy Policy</title>
@endsection
@section('client-content')

<!--Banner Start-->
<div class="banner-area flex" style="background-image:url({{ $banner->privacy_and_policy ? url($banner->privacy_and_policy) : '' }});">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="banner-text">
                    <h1>{{ $navigation->privacy_policy }}</h1>
                    <ul>
                        <li><a href="{{ url('/') }}">{{ $navigation->home }}</a></li>
                        <li><span>{{ $navigation->privacy_policy }}</span></li>
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
                @if ($privacy_count != 0)
                {!! clean($condition->privacy_policy) !!}
                @endif

            </div>
        </div>
    </div>
</div>

@endsection
