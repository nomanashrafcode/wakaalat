@extends('layouts.admin.layout')
@section('title')
<title>{{ $website_lang->where('lang_key','work_section')->first()->custom_lang }}</title>
@endsection
@section('admin-content')
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $website_lang->where('lang_key','work_section')->first()->custom_lang }}</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.work.update',$work->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="form-group">
                            <label for="">{{ $website_lang->where('lang_key','exist_image')->first()->custom_lang }}</label>
                            <img class="ml-4" src="{{ url($work->image) }}" alt="Work Bg image" width="120px">

                        </div>
                        <div class="form-group">
                            <label for="image">{{ $website_lang->where('lang_key','new_image')->first()->custom_lang }}</label>
                            <input type="file" name="image" class="form-control" id="image">

                        </div>
                        <div class="form-group">
                            <label for="video">{{ $website_lang->where('lang_key','video_link')->first()->custom_lang }}</label>
                            <input type="text" name="video" class="form-control" id="video" value="{{ $work->video }}">

                        </div>
                        <div class="form-group">
                            <label for="title">{{ $website_lang->where('lang_key','title')->first()->custom_lang }}</label>
                            <input type="text" name="title" class="form-control" id="title" value="{{ $work->title }}">

                        </div>

                        <div class="form-group">
                            <label for="description">{{ $website_lang->where('lang_key','description')->first()->custom_lang }}</label>
                            <textarea name="description" id="description" cols="30" rows="3" class="form-control" >{{ $work->description }}</textarea>


                        </div>
                        <button type="submit" class="btn btn-success">{{ $website_lang->where('lang_key','update')->first()->custom_lang }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
