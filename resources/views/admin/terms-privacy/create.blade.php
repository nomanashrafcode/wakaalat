@extends('layouts.admin.layout')
@section('title')
<title>{{ $website_lang->where('lang_key','terms_and_cond')->first()->custom_lang }}</title>
@endsection
@section('admin-content')
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">

                <div class="card-body">

                    <form action="{{ route('admin.terms-privacy.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="terms_condition">{{ $website_lang->where('lang_key','terms_and_cond')->first()->custom_lang }}</label>
                            <textarea class="summernote" id="terms_condition" name="terms_condition"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="privacy_policy">{{ $website_lang->where('lang_key','privacy_policy')->first()->custom_lang }}</label>
                            <textarea class="summernote" id="privacy_policy" name="privacy_policy"></textarea>
                        </div>

                        <button type="submit" class="btn btn-success">{{ $website_lang->where('lang_key','save')->first()->custom_lang }} </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
