@extends('layouts.admin.layout')
@section('title')
<title>{{ $website_lang->where('lang_key','preloader')->first()->custom_lang }}</title>
@endsection
@section('admin-content')
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $website_lang->where('lang_key','preloader')->first()->custom_lang }}</h6>
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.preloader.update',$setting->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">{{ $website_lang->where('lang_key','exist_image')->first()->custom_lang }}</label>
                                    @if ($setting->preloader_image)
                                    <img src="{{ url($setting->preloader_image) }}" alt="preloader icon" width="100px">
                                    @else
                                    <img src="" alt="preloader icon">
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">{{ $website_lang->where('lang_key','new_image')->first()->custom_lang }}</label>
                            <input type="file" name="preloader_image" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">{{ $website_lang->where('lang_key','allow_preloader')->first()->custom_lang }}</label>
                            <select name="preloader" id="" class="form-control">
                                <option {{ $setting->preloader==1 ? 'selected':'' }} value="1">{{ $website_lang->where('lang_key','yes')->first()->custom_lang }}</option>
                                <option {{ $setting->preloader==0 ? 'selected':'' }} value="0">{{ $website_lang->where('lang_key','no')->first()->custom_lang }}</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success">Update Info</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
