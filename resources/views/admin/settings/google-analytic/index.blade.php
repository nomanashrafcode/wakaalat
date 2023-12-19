@extends('layouts.admin.layout')
@section('title')
<title>{{ $website_lang->where('lang_key','google_analytic')->first()->custom_lang }}</title>
@endsection
@section('admin-content')
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $website_lang->where('lang_key','google_analytic')->first()->custom_lang }}</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.google.analytic.update') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">{{ $website_lang->where('lang_key','allow_analytic')->first()->custom_lang }}</label>
                            <select name="google_analytic" id="" class="form-control">
                                <option {{ $setting->google_analytic==1 ? 'selected':'' }} value="1">{{ $website_lang->where('lang_key','active')->first()->custom_lang }}</option>
                                <option {{ $setting->google_analytic==0 ? 'selected':'' }} value="0">{{ $website_lang->where('lang_key','inactive')->first()->custom_lang }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="google_analytic_code">{{ $website_lang->where('lang_key','analytic_id')->first()->custom_lang }}</label>
							<input type="text" class="form-control" name="google_analytic_code" id="google_analytic_code" value="{{ $setting->google_analytic_code }}">
                        </div>
                        <button type="submit" class="btn btn-success">{{ $website_lang->where('lang_key','update')->first()->custom_lang }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
