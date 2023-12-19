@extends('layouts.admin.layout')
@section('title')
<title>{{ $website_lang->where('lang_key','lawyer')->first()->custom_lang }}</title>
@endsection
@section('admin-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><a href="{{ route('admin.lawyer.index') }}" class="btn btn-primary"><i class="fas fa-list" aria-hidden="true"></i> {{ $website_lang->where('lang_key','all_lawyer')->first()->custom_lang }} </a></h1>
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $website_lang->where('lang_key','lawyer_form')->first()->custom_lang }}</h6>
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.lawyer.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">{{ $website_lang->where('lang_key','name')->first()->custom_lang }} *</label>
                                    <input type="text" name="name" class="form-control" id="name"  value="{{ old('name') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">{{ $website_lang->where('lang_key','email')->first()->custom_lang }} *</label>
                                    <input type="text" name="email" class="form-control" id="email"  value="{{ old('email') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">{{ $website_lang->where('lang_key','phone')->first()->custom_lang }} *</label>
                                    <input type="text" name="phone" class="form-control" id="phone"  value="{{ old('phone') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">{{ $website_lang->where('lang_key','password')->first()->custom_lang }} *</label>
                                    <input type="password" name="password" class="form-control" id="password" value="{{ old('password') }}">
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="designations">{{ $website_lang->where('lang_key','designation')->first()->custom_lang }} *</label>
                                    <input type="text" name="designations" class="form-control" id="designations" value="{{ old('designations') }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="image">{{ $website_lang->where('lang_key','image')->first()->custom_lang }} *</label>
                                    <input type="file" name="image" class="form-control" id="image" >
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="appointment_fee">{{ $website_lang->where('lang_key','appointment_fee')->first()->custom_lang }} *</label>
                                    <input type="text" name="appointment_fee" class="form-control" id="appointment_fee"  value="{{ old('appointment_fee') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="department">{{ $website_lang->where('lang_key','department')->first()->custom_lang }} *</label>
                                    <select name="department" id="department" class="form-control">
                                        <option value="">{{ $website_lang->where('lang_key','select_department')->first()->custom_lang }}</option>
                                        @foreach ($departments as $item)
                                        <option {{ old('department')==$item->id? 'selected' : ''}} value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="location">{{ $website_lang->where('lang_key','location')->first()->custom_lang }}*</label>
                                    <select name="location" id="location" class="form-control">
                                        <option value="">{{ $website_lang->where('lang_key','select_location')->first()->custom_lang }}</option>
                                        @foreach ($locations as $item)
                                        <option {{ old('location')==$item->id? 'selected' : ''}} value="{{ $item->id }}">{{ ucfirst($item->location) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="facebook">{{ $website_lang->where('lang_key','facebook')->first()->custom_lang }}</label>
                                    <input type="text" class="form-control" name="facebook" id="facebook" value="{{ old('facebook') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="twitter">{{ $website_lang->where('lang_key','twitter')->first()->custom_lang }}</label>
                                    <input type="text" class="form-control" name="twitter" id="twitter"  value="{{ old('twitter') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="linkedin">{{ $website_lang->where('lang_key','linkedin')->first()->custom_lang }}</label>
                                    <input type="text" class="form-control" name="linkedin" id="linkedin">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="about">{{ $website_lang->where('lang_key','about')->first()->custom_lang }}</label>
                                    <textarea name="about" id="about" cols="30" rows="5" class="form-control">{{ old('about') }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="address">{{ $website_lang->where('lang_key','address')->first()->custom_lang }}</label>
                                    <textarea name="address" id="address" class="summernote">{{ old('address') }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="educations">{{ $website_lang->where('lang_key','education')->first()->custom_lang }}</label>
                                    <textarea name="educations" id="educations" class="summernote">{{ old('educations') }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="experiences">{{ $website_lang->where('lang_key','experience')->first()->custom_lang }}</label>
                                    <textarea name="experiences" id="experiences" class="summernote">{{ old('experiences') }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="qualifications">{{ $website_lang->where('lang_key','qualification')->first()->custom_lang }}</label>
                                    <textarea name="qualifications" id="qualifications" class="summernote">{{ old('qualifications') }}</textarea>
                                </div>
                            </div>


                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status">{{ $website_lang->where('lang_key','status')->first()->custom_lang }} *</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="1">{{ $website_lang->where('lang_key','active')->first()->custom_lang }}</option>
                                        <option value="0">{{ $website_lang->where('lang_key','inactive')->first()->custom_lang }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="show_homepage">{{ $website_lang->where('lang_key','show_homepage')->first()->custom_lang }} *</label>
                                    <select name="show_homepage" id="show_homepage" class="form-control">
                                        <option value="0">{{ $website_lang->where('lang_key','no')->first()->custom_lang }}</option>
                                        <option value="1">{{ $website_lang->where('lang_key','yes')->first()->custom_lang }}</option>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="seo_title">{{ $website_lang->where('lang_key','seo_title')->first()->custom_lang }}</label>
                                    <input type="text" name="seo_title" class="form-control" id="seo_title" value="{{ old('seo_title') }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="seo_description">{{ $website_lang->where('lang_key','seo_description')->first()->custom_lang }}</label>
                                    <textarea name="seo_description" id="seo_description" cols="30" rows="3" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>


                        <button type="submit" class="btn btn-success">{{ $website_lang->where('lang_key','save')->first()->custom_lang }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
