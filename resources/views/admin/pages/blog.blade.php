@extends('layouts.admin.layout')
@section('title')
<title>{{ $website_lang->where('lang_key','blog_page')->first()->custom_lang }}</title>
@endsection
@section('admin-content')
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $website_lang->where('lang_key','blog_page')->first()->custom_lang }}</h6>
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.blog.page.update') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">{{ $website_lang->where('lang_key','title')->first()->custom_lang }}</label>
                            <input type="text" name="blog_title" class="form-control" value="{{ $page->blog_title }}">
                        </div>
                        <div class="form-group">
                            <label for="home_meta_description">{{ $website_lang->where('lang_key','meta_des')->first()->custom_lang }}</label>
                            <textarea name="blog_meta_description" id="home_meta_description" cols="30" rows="5" class="form-control">{{ $page->blog_meta_description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="show_navbar">{{ $website_lang->where('lang_key','show_navber')->first()->custom_lang }}</label>
                            <select name="show_navbar" id="show_navbar" class="form-control">
                                <option {{ $navigation->show_blog==1 ? 'selected':'' }} value="1">{{ $website_lang->where('lang_key','yes')->first()->custom_lang }}</option>
                                <option {{ $navigation->show_blog==0 ? 'selected':'' }} value="0">{{ $website_lang->where('lang_key','no')->first()->custom_lang }}</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success">{{ $website_lang->where('lang_key','update')->first()->custom_lang }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
