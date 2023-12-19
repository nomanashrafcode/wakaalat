@extends('layouts.client.layout')
@section('title')
<title>{{ $website_lang->where('lang_key','change_pass')->first()->custom_lang }}</title>
@endsection
@section('client-content')


<!--Banner Start-->
<div class="banner-area flex" style="background-image:url({{ url($banner->profile) }});">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="banner-text">
                    <h1>{{ $website_lang->where('lang_key','change_pass')->first()->custom_lang }}</h1>
                    <ul>
                        <li><a href="{{ url('/') }}">{{ $navigation->home }}</a></li>
                        <li><span>{{ $website_lang->where('lang_key','change_pass')->first()->custom_lang }}</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Banner End-->

<!--Dashboard Start-->
<div class="dashboard-area pt_70 pb_70">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                @include('client.profile.sidebar')
            </div>
            <div class="col-lg-9">
                <div class="detail-dashboard add-form">
                    <h2 class="d-headline">{{ $website_lang->where('lang_key','change_pass')->first()->custom_lang }}</h2>
                    <form action="{{ route('client.update.password') }}" method="post">
                        @csrf
                        <div class="form-row row">
                            <div class="form-group col-md-6">
                                <label for="">{{ $website_lang->where('lang_key','password')->first()->custom_lang }} <span>*</span></label>
                                <input type="password" class="form-control" name="password">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">{{ $website_lang->where('lang_key','confirm_pass')->first()->custom_lang }} <span>*</span></label>
                                <input type="password" class="form-control" name="password_confirmation">
                            </div>
                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-primary">{{ $website_lang->where('lang_key','update')->first()->custom_lang }}</button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<!--Dashboard End-->

@endsection
