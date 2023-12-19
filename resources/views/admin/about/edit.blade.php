@extends('layouts.admin.layout')
@section('title')
<title>{{ $website_lang->where('lang_key','about_us')->first()->custom_lang }}</title>
@endsection
@section('admin-content')
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                          <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">{{ $website_lang->where('lang_key','about')->first()->custom_lang }}</a>
                        </li>
                        <li class="nav-item" role="presentation">
                          <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">{{ $website_lang->where('lang_key','mission')->first()->custom_lang }}</a>
                        </li>
                        <li class="nav-item" role="presentation">
                          <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">{{ $website_lang->where('lang_key','vision')->first()->custom_lang }}</a>
                        </li>
                      </ul>
                      <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active mt-5" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <form action="{{ route('admin.update.about.section',$about->id) }}" enctype="multipart/form-data" method="POST">
                                @csrf

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">{{ $website_lang->where('lang_key','exist_image')->first()->custom_lang }}</label>
                                            <div><img class="w_200" src="{{ url($about->about_image) }}" alt="About Image"></div>
                                            <input type="hidden" name="old_about_image" value="{{ $about->about_image }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="">{{ $website_lang->where('lang_key','new_image')->first()->custom_lang }}</label>
                                            <div><input type="file" name="image"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">{{ $website_lang->where('lang_key','exist_bg_image')->first()->custom_lang }}</label>
                                            <div><img class="w_200" src="{{ url($about->background_image) }}" alt="About Background Image"></div>
                                            <input type="hidden" name="old_background_image" value="{{ $about->background_image }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="">{{ $website_lang->where('lang_key','new_bg_image')->first()->custom_lang }}</label>
                                            <div><input type="file" name="background_image"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="sep"></div>

                                <div class="form-group">
                                    <label for="about_description">{{ $website_lang->where('lang_key','description')->first()->custom_lang }}</label>
                                    <textarea name="about_description" id="about_description" class="summernote">{{ $about->about_description }}</textarea>
                                </div>


                                <button class="btn btn-success" type="submit">{{ $website_lang->where('lang_key','update')->first()->custom_lang }}</button>
                            </form>
                        </div>
                        <div class="tab-pane fade mt-5" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <form action="{{ route('admin.update.mission.section',$about->id) }}" enctype="multipart/form-data" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="">{{ $website_lang->where('lang_key','exist_image')->first()->custom_lang }}</label>
                                    <div><img class="w_200" src="{{ url($about->mission_image) }}" alt="Mission Image"></div>
                                    <input type="hidden" name="old_mission_image" value="{{ $about->mission_image }}">
                                </div>
                                <div class="form-group">
                                    <label for="">{{ $website_lang->where('lang_key','new_image')->first()->custom_lang }}</label>
                                    <div><input type="file" name="image"></div>
                                </div>

                                <div class="form-group">
                                    <label for="mission_description">{{ $website_lang->where('lang_key','description')->first()->custom_lang }}</label>
                                    <textarea name="mission_description" id="mission_description" class="summernote">{{ $about->mission_description }}</textarea>
                                </div>


                                <button class="btn btn-success" type="submit">{{ $website_lang->where('lang_key','update')->first()->custom_lang }}</button>
                            </form>
                        </div>
                        <div class="tab-pane fade mt-5" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            <form action="{{ route('admin.update.vision.section',$about->id) }}" enctype="multipart/form-data" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="">{{ $website_lang->where('lang_key','exist_image')->first()->custom_lang }}</label>
                                    <div><img class="w_200" src="{{ url($about->vision_image) }}" alt="Vision Image"></div>
                                    <input type="hidden" name="old_vision_image" value="{{ $about->vision_image }}">
                                </div>

                                <div class="form-group">
                                    <label for="">{{ $website_lang->where('lang_key','new_image')->first()->custom_lang }}</label>
                                    <div><input type="file" name="image"></div>
                                </div>

                                <div class="form-group">
                                    <label for="vision_description">{{ $website_lang->where('lang_key','description')->first()->custom_lang }}</label>
                                    <textarea name="vision_description" id="vision_description" class="summernote">{{ $about->vision_description }}</textarea>
                                </div>


                                <button class="btn btn-success" type="submit">{{ $website_lang->where('lang_key','update')->first()->custom_lang }}</button>
                            </form>
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
@endsection

