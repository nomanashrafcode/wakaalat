@extends('layouts.admin.layout')
@section('title')
<title>{{ $website_lang->where('lang_key','setting')->first()->custom_lang }}</title>
@endsection
@section('admin-content')
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $website_lang->where('lang_key','cookie_consent')->first()->custom_lang }}</h6>
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.update.cookie.consent.setting') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="">{{ $website_lang->where('lang_key','all_cookie')->first()->custom_lang }}</label>
                            <select name="allow_cookie_consent" id="" class="form-control">
                                <option {{ $setting->allow_cookie_consent==1 ? 'selected':'' }} value="1">{{ $website_lang->where('lang_key','yes')->first()->custom_lang }}</option>
                                <option {{ $setting->allow_cookie_consent==0 ? 'selected':'' }} value="0">{{ $website_lang->where('lang_key','no')->first()->custom_lang }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="cookie_text">{{ $website_lang->where('lang_key','cookie_text')->first()->custom_lang }}</label>
                            <textarea class="form-control" name="cookie_text" id="cookie_text" cols="30" rows="5">{{ $setting->cookie_text }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="cookie_text">{{ $website_lang->where('lang_key','btn_text')->first()->custom_lang }}</label>
                            <input type="text" name="cookie_button_text" value="{{ $setting->cookie_button_text }}" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-success">{{ $website_lang->where('lang_key','update')->first()->custom_lang }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
