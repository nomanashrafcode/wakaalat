@extends('layouts.client.layout')
@section('title')
<title>{{ $title_meta->lawyer_title }}</title>
@endsection
@section('meta')
<meta name="description" content="{{ $title_meta->lawyer_meta_description }}">
@endsection
@section('client-content')

<!--Banner Start-->
<div class="banner-area flex" style="background-image:url({{ $banner->lawyer ? url($banner->lawyer) : '' }});">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="banner-text">
                    <h1>{{ $navigation->lawyer }}</h1>
                    <ul>
                        <li><a href="{{ url('/') }}">{{ $navigation->home }}</a></li>
                        <li><span>{{ $navigation->lawyer }}</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Banner End-->


<div class="doctor-search">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="s-container">
                <form action="{{ url('search-lawyer') }}">

                    <div class="s-box">
                        <select name="location" class="form-control select2">
                            <option value="">{{ $website_lang->where('lang_key','select_location')->first()->custom_lang }}</option>
                            @foreach ($locations as $location)
                            <option {{ @$location_id==$location->id?'selected':'' }} value="{{ $location->id }}">{{ ucwords($location->location) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="s-box">
                        <select name="department" class="form-control select2">
                            <option value="">{{ $website_lang->where('lang_key','select_department')->first()->custom_lang }}</option>
                            @foreach ($departments as $department)
                            <option {{ @$department_id==$department->id?'selected':'' }} value="{{ $department->id }}">{{ ucwords($department->name) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="s-box">
                        <select name="lawyer" class="form-control select2">
                            <option value="">{{ $website_lang->where('lang_key','select_lawyer')->first()->custom_lang }}</option>
                            @foreach ($lawyersForSearch as $lawyer)
                            <option {{ @$lawyer_id==$lawyer->id?'selected':'' }} value="{{ $lawyer->id }}">{{ $lawyer->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="s-button">
                        <button type="submit">{{ $website_lang->where('lang_key','search')->first()->custom_lang }}</button>
                    </div>
                </form>
                </div>

            </div>
        </div>
    </div>
</div>




<!--Service Start-->
<div class="team-page pt_40 pb_70">
    <div class="container">
        <div class="row">

            @if ($lawyers->count()!=0)
            @foreach ($lawyers as $lawyer)
            <div class="col-lg-3 col-md-4 col-6 mt_30">
                <div class="team-item">
                    <div class="team-photo">
                        <img src="{{ url($lawyer->image) }}" alt="Team Photo">
                    </div>
                    <div class="team-text">
                        <a href="{{ url('lawyer-details/'.$lawyer->slug) }}">{{ $lawyer->name }}</a>
                        <p>{{ $lawyer->department->name }}</p>
                        <p><span><i class="fas fa-graduation-cap"></i> {{ $lawyer->designations }}</span></p>
                        <p><span><b><i class="fas fa-street-view"></i> {{ ucfirst($lawyer->location->location) }}</b></span></p>
                    </div>
                    <div class="team-social">
                        <ul>
                            @if ($lawyer->facebook)
                            <li><a href="{{ $lawyer->facebook }}"><i class="fab fa-facebook-f"></i></a></li>
                            @endif
                            @if ($lawyer->twitter)
                            <li><a href="{{ $lawyer->twitter }}"><i class="fab fa-twitter"></i></a></li>
                            @endif
                            @if ($lawyer->linkedin)
                            <li><a href="{{ $lawyer->linkedin }}"><i class="fab fa-linkedin"></i></a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            @endforeach
            @else
            <h3 class="text-danger text-center">{{ $website_lang->where('lang_key','lawyer_not_found')->first()->custom_lang }}</h3>
            @endif


        </div>
        {{ @$lawyers->links('client.paginator') }}
    </div>
</div>
<!--Service End-->






@endsection
