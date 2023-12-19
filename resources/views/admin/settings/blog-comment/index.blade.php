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
                    <h6 class="m-0 font-weight-bold text-primary">{{ $website_lang->where('lang_key','blog_comment')->first()->custom_lang }}</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.update.comment.setting') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">Comment type</label>
                            <select name="comment_type" id="" class="form-control">
                                <option {{ $setting->comment_type==1 ? 'selected':'' }} value="1">{{ $website_lang->where('lang_key','custom_comment')->first()->custom_lang }}</option>
                                <option {{ $setting->comment_type==0 ? 'selected':'' }} value="0">{{ $website_lang->where('lang_key','fb_comment')->first()->custom_lang }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="facebook_comment_script">{{ $website_lang->where('lang_key','fb_app')->first()->custom_lang }}</label>
							<input type="text" class="form-control" name="facebook_comment_script" id="facebook_comment_script" value="{{ $setting->facebook_comment_script }}">
                        </div>
                        <button type="submit" class="btn btn-success">{{ $website_lang->where('lang_key','update')->first()->custom_lang }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
