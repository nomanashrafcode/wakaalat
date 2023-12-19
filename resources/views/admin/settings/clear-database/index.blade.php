@extends('layouts.admin.layout')
@section('title')
<title>{{ $website_lang->where('lang_key','clear_database')->first()->custom_lang }}</title>
@endsection
@section('admin-content')
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $website_lang->where('lang_key','clear_database')->first()->custom_lang }}</h6>
                </div>
                <div class="card-body">
                    <a class="btn btn-danger" href="{{ route('admin.clear.all.data') }}" onclick="return confirm('{{ $website_lang->where('lang_key','are_you_sure')->first()->custom_lang }}')">{{ $website_lang->where('lang_key','clear_data')->first()->custom_lang }}</a>
                </div>
            </div>
        </div>
    </div>

@endsection
