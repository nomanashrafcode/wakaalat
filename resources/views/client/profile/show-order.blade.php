@extends('layouts.client.layout')
@section('title')
<title>{{ $website_lang->where('lang_key','order')->first()->custom_lang }}</title>
@endsection
@section('client-content')


<!--Banner Start-->
<div class="banner-area flex" style="background-image:url({{ $banner->profile ? url($banner->profile) : '' }});">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="banner-text">
                    <h1>{{ $website_lang->where('lang_key','order')->first()->custom_lang }}</h1>
                    <ul>
                        <li><a href="{{ url('/') }}">{{ $navigation->home }}</a></li>
                        <li><span>{{ $website_lang->where('lang_key','order')->first()->custom_lang }}</span></li>
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
                    <div class="prescription">
                        <div class="top">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="logo custom_logo_mb"><img src="{{ url($setting->logo) }}" alt=""></div>

                                    <div class="address">
                                        <i class="fas fa-phone-alt"></i> {{ $contact->phones }}
                                    </div>
                                    <div class="address">
                                        <i class="fas fa-envelope"></i> {{ $contact->emails }}
                                    </div>

                                    <div class="address">
                                        <i class="fas fa-map-marker-alt"></i> {{ $contact->address }}
                                    </div>
                                </div>

                            </div>
                        </div>




                        <div class="mt-3">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>{{ $website_lang->where('lang_key','lawyer')->first()->custom_lang }}</th>
                                        <th>{{ $website_lang->where('lang_key','phone')->first()->custom_lang }}</th>
                                        <th>{{ $website_lang->where('lang_key','schedule')->first()->custom_lang }}</th>
                                        <th>{{ $website_lang->where('lang_key','date')->first()->custom_lang }}</th>
                                        <th>{{ $website_lang->where('lang_key','appointment_fee')->first()->custom_lang }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->appointments as $index => $item)
                                    <tr>
                                        <td>{{ $item->lawyer->name }}</td>
                                        <td>{{ $item->lawyer->phone }}</td>
                                        <td>{{ strtoupper($item->schedule->start_time).'-'.strtoupper($item->schedule->end_time) }}</td>
                                        <td>{{ $item->date }}</td>
                                        <td>
                                            ${{ $item->appointment_fee }}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>




                    </div>

                </div>

                <button class="btn btn-primary mt-3 print-btn" onclick="window.print()"><i class="fas fa-print" aria-hidden="true"></i></button>




            </div>
        </div>
    </div>
</div>
<!--Dashboard End-->


@endsection
