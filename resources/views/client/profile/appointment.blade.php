@extends('layouts.client.layout')
@section('title')
<title>{{ $website_lang->where('lang_key','appointment_list')->first()->custom_lang }}</title>
@endsection
@section('client-content')


<!--Banner Start-->
<div class="banner-area flex" style="background-image:url({{ $banner->profile ? url($banner->profile) : '' }});">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="banner-text">
                    <h1>{{ $website_lang->where('lang_key','appointment_list')->first()->custom_lang }}</h1>
                    <ul>
                        <li><a href="{{ url('/') }}">{{ $navigation->home }}</a></li>
                        <li><span>{{ $website_lang->where('lang_key','appointment_list')->first()->custom_lang }}</span></li>
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
                <h2 class="d-headline">{{ $website_lang->where('lang_key','appointment_list')->first()->custom_lang }}</h2>
                <div class="table-responsive">
                <table class="coustom-dashboard dashboard-table display" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th  width="3%">{{ $website_lang->where('lang_key','serial')->first()->custom_lang }}</th>
                                <th  width="15%">{{ $website_lang->where('lang_key','lawyer')->first()->custom_lang }}</th>
                                <th  width="20%">{{ $website_lang->where('lang_key','date')->first()->custom_lang }}</th>
                                <th  width="10%">{{ $website_lang->where('lang_key','appointment_fee')->first()->custom_lang }}</th>
                                <th  width="30%">{{ $website_lang->where('lang_key','schedule')->first()->custom_lang }}</th>
                                <th  width="10%">{{ $website_lang->where('lang_key','payment')->first()->custom_lang }}</th>
                                <th  width="7%">{{ $website_lang->where('lang_key','action')->first()->custom_lang }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($appointments as $index => $appointment)
                            <tr>
                                <td>{{ ++$index }}</td>
                                <td>{{ $appointment->lawyer->name }}</td>
                                <td>{{ date('m-d-Y',strtotime($appointment->date)) }}</td>
                                <td>{{ $currency->currency_icon }}{{ $appointment->appointment_fee }}</td>
                                <td>{{ strtoupper($appointment->schedule->start_time).'-'.strtoupper($appointment->schedule->end_time) }}</td>
                                <td>
                                    @if ($appointment->payment_status==0)
                                        <span class="badge badge-danger">Pending</span>
                                    @else
                                    <span class="badge badge-success">Success</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($appointment->already_treated==1)
                                    <a href="{{ route('client.show-appointment',$appointment->id) }}" class="btn btn-success btn-sm"><i class="fas fa-eye"></i></a>
                                 @endif
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>

                    {{ $appointments->links() }}
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Dashboard End-->
@endsection
