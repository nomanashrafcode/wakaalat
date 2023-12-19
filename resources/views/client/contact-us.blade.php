@extends('layouts.client.layout')
@section('title')
<title>{{ $title_meta->contactus_title }}</title>
@endsection
@section('meta')
<meta name="description" content="{{ $title_meta->contactus_meta_description }}">
@endsection
@section('client-content')

<!--Banner Start-->
<div class="banner-area flex" style="background-image:url({{ $banner->contact ? url($banner->contact) : '' }});">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="banner-text">
                    <h1>{{ $navigation->contact_us }}</h1>
                    <ul>
                        <li><a href="{{ url('/') }}">{{ $navigation->home }}</a></li>
                        <li><span>{{ $navigation->contact_us }}</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Banner End-->

<!--Form Start-->
<div class="contauct-style1  pt_50 pb_65">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="about1-text mt_30">
                    <h1>{{ $contactUs->header }}</h1>
                    <p class="mb_30">
                        {{ $contactUs->description }}
                    </p>
                </div>
                <form action="{{ url('contact-message') }}" method="POST">
                    @csrf
                    <div class="row contact-form">
                        <div class="col-lg-6 form-group">
                            <label>{{ $website_lang->where('lang_key','name')->first()->custom_lang }} *</label>
                            <input type="text" class="form-control" id="name"  name="name">
                        </div>
                        <div class="col-lg-6 form-group">
                            <label>{{ $website_lang->where('lang_key','email')->first()->custom_lang }} *</label>
                            <input type="email" id="email" class="form-control"  name="email">
                        </div>
                        <div class="col-lg-6 form-group">
                            <label>{{ $website_lang->where('lang_key','phone')->first()->custom_lang }}</label>
                            <input type="text" id="phone" name="phone" class="form-control">
                        </div>
                        <div class="col-lg-6 form-group">
                            <label>{{ $website_lang->where('lang_key','subject')->first()->custom_lang }} *</label>
                            <input type="text" id="subject" class="form-control" name="subject">
                        </div>
                        <div class="col-lg-12 form-group">
                            <label>{{ $website_lang->where('lang_key','message')->first()->custom_lang }} *</label>
                            <textarea name="message" class="form-control" id="massege"></textarea>
                        </div>
                        @if ($setting->allow_captcha==1)
                        <div class="form-group col-12">
                            <div class="g-recaptcha" data-sitekey="{{ $setting->captcha_key }}"></div>
                        </div>
                        @endif
                        <div class="col-md-12 form-group">
                            <button type="submit" class="btn">{{ $website_lang->where('lang_key','send_message')->first()->custom_lang }}</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-5">
                <div class="contact-info-item bg1 mb_30 mt_30">
                    <div class="contact-info">
                        <span>
                            <i class="fas fa-phone"></i> {{ $website_lang->where('lang_key','phone')->first()->custom_lang }}:
                        </span>
                        <div class="contact-text">
                            <a href="tel:(+29) 111 2222 300">
                                 {!! clean(nl2br($contactUs->phones)) !!}</a>
                            <br>
                        </div>
                    </div>
                </div>
                <div class="contact-info-item bg2 mb_30">
                    <div class="contact-info">
                        <span>
                            <i class="far fa-envelope"></i> {{ $website_lang->where('lang_key','email_address')->first()->custom_lang }}:
                        </span>
                        <div class="contact-text">
                            <a href="mailto:info@yourbestdomain.com">{!! nl2br(e($contactUs->emails)) !!}</a>

                        </div>
                    </div>
                </div>
                <div class="contact-info-item bg3 mb_30">
                    <div class="contact-info">
                        <span>
                            <i class="fas fa-map-marker-alt"></i> {{ $website_lang->where('lang_key','address')->first()->custom_lang }}:
                        </span>
                        <div class="contact-text">
                            <p>
                                {!! clean(nl2br($contactUs->address)) !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Form End-->

<!--Google map start-->
<div class="map-area">
    {!! clean($contactUs->map_embed_code) !!}
</div>
<!--Google map end-->



@endsection
