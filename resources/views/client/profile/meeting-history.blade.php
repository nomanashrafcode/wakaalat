@extends('layouts.client.layout')
@section('title')
<title>{{ $website_lang->where('lang_key','meeting_history')->first()->custom_lang }}</title>
@endsection
@section('client-content')


<!--Banner Start-->
<div class="banner-area flex" style="background-image:url({{ $banner->profile ? url($banner->profile) : '' }});">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="banner-text">
                    <h1>{{ $website_lang->where('lang_key','meeting_history')->first()->custom_lang }}</h1>
                    <ul>
                        <li><a href="{{ url('/') }}">{{ $navigation->home }}</a></li>
                        <li><span>{{ $website_lang->where('lang_key','meeting_history')->first()->custom_lang }}</span></li>
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
                    <h2 class="d-headline">{{ $website_lang->where('lang_key','meeting_history')->first()->custom_lang }}</h2>
                    <div class="table-responsive">
                        <table class="coustom-dashboard dashboard-table display" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th >{{ $website_lang->where('lang_key','serial')->first()->custom_lang }}</th>
                                    <th >{{ $website_lang->where('lang_key','lawyer')->first()->custom_lang }}</th>
                                    <th >{{ $website_lang->where('lang_key','time')->first()->custom_lang }}</th>
                                    <th >{{ $website_lang->where('lang_key','duration')->first()->custom_lang }}</th>
                                    <th >{{ $website_lang->where('lang_key','meeting_id')->first()->custom_lang }}</th>
                                    <th >{{ $website_lang->where('lang_key','join_link')->first()->custom_lang }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i=0;
                                @endphp
                                @foreach ($histories as $index => $meeting)
                                @php
                                    $now=date('Y-m-d h:i:A');
                                @endphp

                                @if ($now > date('Y-m-d h:i:A',strtotime($meeting->meeting_time)))
                                <tr>
                                    <td>{{ ++$i}}</td>
                                    <td>{{ $meeting->lawyer->name }}</td>
                                    <td>
                                        {{ date('Y-m-d h:i:A',strtotime($meeting->meeting_time)) }}
                                    </td>
                                    <td>{{ $meeting->duration }} {{ $website_lang->where('lang_key','minute')->first()->custom_lang }}</td>
                                    <td>{{ $meeting->meeting->meeting_id }}</td>
                                    <td>
                                            @php
                                                $time=date('Y-m-d h:i:A',strtotime($meeting->meeting_time));
                                                $hexacode=strtotime($meeting->meeting_time) + 60*$meeting->duration;
                                            @endphp
                                            @if ($now < date('Y-m-d h:i:A',$hexacode))
                                                @if (env('PROJECT_MODE')==0)
                                                    <a id="zoom_demo_mode" href="javascript:;"  class="btn btn-success btn-sm"><i class="fas fa-video"></i></a>
                                                @else
                                                <a target="_blank" href="{{ $meeting->meeting->join_url }}" class="btn btn-success btn-sm"><i class="fas fa-video"></i></a>
                                                @endif
                                            @else
                                            <a href="javascript:;"  class="btn btn-success btn-sm disabled"><i class="fas fa-video"></i></a>
                                            @endif


                                    </td>
                                </tr>
                                @endif
                                @endforeach

                            </tbody>
                        </table>
                        {{ $histories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Dashboard End-->


@endsection
