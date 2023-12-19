@extends('layouts.admin.layout')
@section('title')
<title>{{ $website_lang->where('lang_key','department')->first()->custom_lang }}</title>
@endsection
@section('admin-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><a href="{{ route('admin.department.index') }}" class="btn btn-primary"><i class="fas fa-list" aria-hidden="true"></i> {{ $website_lang->where('lang_key','all_department')->first()->custom_lang }} </a></h1>
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-10">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $website_lang->where('lang_key','department_form')->first()->custom_lang }}</h6>
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.department.update',$department->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">{{ $website_lang->where('lang_key','name')->first()->custom_lang }}</label>
                                    <input type="text" class="form-control" name="name" id="name" value="{{ $department->name }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="thumbnail_image">{{ $website_lang->where('lang_key','thum_img')->first()->custom_lang }}</label>
                                    <input type="file" class="form-control" name="thumbnail_image" id="thumbnail_image">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="thumbnail_image">{{ $website_lang->where('lang_key','exist_image')->first()->custom_lang }}</label>
                                    <img src="{{ url($department->thumbnail_image) }}" alt="Department thumbnail" width="120px">
                                </div>
                            </div>


                        </div>


                        <div class="form-group">
                            <label for="description">{{ $website_lang->where('lang_key','description')->first()->custom_lang }}</label>
                            <textarea class="summernote" id="description" name="description">{{ $department->description }}</textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status">{{ $website_lang->where('lang_key','status')->first()->custom_lang }}</label>
                                    <select name="status" id="status" class="form-control">
                                        <option {{ $department->status ==1 ? 'selected' :'' }} value="1">{{ $website_lang->where('lang_key','active')->first()->custom_lang }}</option>
                                        <option {{ $department->status ==0 ? 'selected' :'' }} value="0">{{ $website_lang->where('lang_key','inactive')->first()->custom_lang }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="show_home_page">{{ $website_lang->where('lang_key','show_homepage')->first()->custom_lang }}</label>
                                    <select name="show_homepage" id="show_home_page" class="form-control">
                                        <option {{ $department->show_homepage ==0 ? 'selected' :'' }} value="0">{{ $website_lang->where('lang_key','no')->first()->custom_lang }}</option>
                                        <option {{ $department->show_homepage ==1 ? 'selected' :'' }} value="1">{{ $website_lang->where('lang_key','yes')->first()->custom_lang }}</option>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="seo_title">{{ $website_lang->where('lang_key','seo_title')->first()->custom_lang }}</label>
                            <input type="text" name="seo_title" class="form-control" id="seo_title" value="{{ $department->seo_title }}">
                        </div>
                        <div class="form-group">
                            <label for="seo_description">{{ $website_lang->where('lang_key','seo_description')->first()->custom_lang }}</label>
                            <textarea name="seo_description" id="seo_description" cols="30" rows="3" class="form-control" >{{ $department->seo_description }}</textarea>
                        </div>


                        <button type="submit" class="btn btn-success">{{ $website_lang->where('lang_key','update')->first()->custom_lang }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
