@extends('layouts.admin.layout')
@section('title')
<title>{{ $website_lang->where('lang_key','subscriber_content')->first()->custom_lang }}</title>
@endsection
@section('admin-content')
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $website_lang->where('lang_key','subscriber_content')->first()->custom_lang }}</h6>
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.subscriber.content.update',$setting->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">{{ $website_lang->where('lang_key','subscribe_heading')->first()->custom_lang }}</label>
                            <input type="text" name="subscribe_heading" class="form-control" value="{{ $setting->subscribe_heading }}">
                        </div>
                        <div class="form-group">
                            <label for="">{{ $website_lang->where('lang_key','subscribe_des')->first()->custom_lang }}</label>
                            <textarea name="subscribe_description" id="" cols="30" rows="5" class="form-control">{{ $setting->subscribe_description }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-success">{{ $website_lang->where('lang_key','update')->first()->custom_lang }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
