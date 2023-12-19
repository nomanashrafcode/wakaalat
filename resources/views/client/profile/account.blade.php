@extends('layouts.client.layout')
@section('title')
<title>{{ $website_lang->where('lang_key','account_info')->first()->custom_lang }}</title>
@endsection
@section('client-content')


<!--Banner Start-->
<div class="banner-area flex" style="background-image:url({{ $banner->profile ? url($banner->profile) : '' }});">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="banner-text">
                    <h1>{{ $website_lang->where('lang_key','account_info')->first()->custom_lang }}</h1>
                    <ul>
                        <li><a href="{{ url('/') }}">{{ $navigation->home }}</a></li>
                        <li><span>{{ $website_lang->where('lang_key','account_info')->first()->custom_lang }}</span></li>
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
                    <h2 class="d-headline">{{ $website_lang->where('lang_key','account_info')->first()->custom_lang }}</h2>
                    <form action="{{ route('client.update.profile') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row row">
                            <div class="form-group col-md-6">
                                <label for="name">{{ $website_lang->where('lang_key','name')->first()->custom_lang }} <span>*</span></label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">{{ $website_lang->where('lang_key','email')->first()->custom_lang }} <span>*</span></label>
                                <input type="text" class="form-control" id="email" name="email"  value="{{ $user->email }}" readonly>

                            </div>
                            <div class="form-group col-md-6">
                                <label for="">{{ $website_lang->where('lang_key','phone')->first()->custom_lang }} <span>*</span></label>
                                <input type="text" class="form-control" name="phone" value="{{ $user->phone }}">

                            </div>
                            <div class="form-group col-md-6">
                                <label for="">{{ $website_lang->where('lang_key','guarding_name')->first()->custom_lang }}</label>
                                <input type="text" class="form-control" name="guardian_name"  value="{{ $user->guardian_name }}">

                            </div>
                            <div class="form-group col-md-6">
                                <label for="">{{ $website_lang->where('lang_key','guardian_phone')->first()->custom_lang }}</label>
                                <input type="text" class="form-control" name="guardian_phone"  value="{{ $user->guardian_phone }}">

                            </div>
                            <div class="form-group col-md-6">
                                <label for="">{{ $website_lang->where('lang_key','age')->first()->custom_lang }}<span>*</span></label>
                                <input type="number" class="form-control" name="age" value="{{ $user->age }}">

                            </div>
                            <div class="form-group col-md-6">
                                <label for="">{{ $website_lang->where('lang_key','occupation')->first()->custom_lang }}<span>*</span></label>
                                <input type="text" class="form-control" name="occupation"  value="{{ $user->occupation }}">

                            </div>

                            <div class="form-group col-md-6 option-item">
                                <label for="">{{ $website_lang->where('lang_key','gender')->first()->custom_lang }} <span>*</span></label>
                                <select class="form-control" name="gender">
                                    <option value="">{{ $website_lang->where('lang_key','select_gender')->first()->custom_lang }}</option>
                                    <option {{ $user->gender==$website_lang->where('lang_key','male')->first()->custom_lang ? 'selected':'' }} value="{{ $website_lang->where('lang_key','male')->first()->custom_lang }}">{{ $website_lang->where('lang_key','male')->first()->custom_lang }}</option>
                                    <option {{ $user->gender==$website_lang->where('lang_key','female')->first()->custom_lang ? 'selected':'' }} value="{{ $website_lang->where('lang_key','female')->first()->custom_lang }}">{{ $website_lang->where('lang_key','female')->first()->custom_lang }}</option>
                                    <option {{ $user->gender==$website_lang->where('lang_key','others')->first()->custom_lang ? 'selected':'' }} value="{{ $website_lang->where('lang_key','others')->first()->custom_lang }}">{{ $website_lang->where('lang_key','others')->first()->custom_lang }}</option>
                                </select>

                            </div>
                            <div class="form-group col-md-6">
                                <label for="">{{ $website_lang->where('lang_key','address')->first()->custom_lang }} <span>*</span></label>
                                <input type="text" class="form-control" name="address" value="{{ $user->address }}">

                            </div>

                            <div class="form-group col-md-6 option-item">
                                <label for="">{{ $website_lang->where('lang_key','country')->first()->custom_lang }} <span>*</span></label>
                                <input type="text" name="country" class="form-control" value="{{ $user->country }}">

                            </div>
                            <div class="form-group col-md-6 option-item">
                                <label for="">{{ $website_lang->where('lang_key','city')->first()->custom_lang }} <span>*</span></label>
                                <input type="text" name="city" placeholder="City" class="form-control" value="{{ $user->city }}">

                            </div>

                            <div class="form-group col-md-6">
                                <label for="">{{ $website_lang->where('lang_key','photo')->first()->custom_lang }}</label>
                                <input type="file" class="form-control-file" name="image">
                                <input type="hidden" name="old_image" value="{{ $user->image }}">

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
