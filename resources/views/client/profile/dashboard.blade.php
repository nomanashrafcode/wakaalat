@extends('layouts.client.layout')
@section('title')
<title>{{ $navigation->dashboard }}</title>
@endsection
@section('client-content')


<!--Banner Start-->
<div class="banner-area flex" style="background-image:url({{ $banner->profile ? url($banner->profile) : '' }});">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="banner-text">
                    <h1>{{ $navigation->dashboard }}</h1>
                    <ul>
                        <li><a href="index.php">{{ $navigation->home }}</a></li>
                        <li><span>{{ $navigation->dashboard }}</span></li>
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
                <div class="detail-dashboard">
                    <div class="row">
                        <div class="col-lg-4 col-sm-6">
                            <div class="dash-item db-blue flex mb_30">
                                <i class="fas fa-handshake"></i>
                                <h4>{{ $website_lang->where('lang_key','total_order')->first()->custom_lang }}</h4>
                                <h2>{{ $orders->count() }}</h2>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="dash-item db-red flex mb_30">
                                <i class="fas fa-hourglass-start"></i>
                                <h4>{{ $website_lang->where('lang_key','pending_appointment')->first()->custom_lang }}</h4>
                                <h2>{{ $orders->where('payment_status',0)->count() }}</h2>

                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="dash-item db-blue flex mb_30">
                                <i class="fas fa-check-circle"></i>
                                <h4>{{ $website_lang->where('lang_key','total_appointment')->first()->custom_lang }}</h4>
                                <h2>{{ $appointments->count() }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Dashboard End-->

@endsection
