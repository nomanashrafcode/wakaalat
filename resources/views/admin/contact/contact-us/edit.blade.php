@extends('layouts.admin.layout')
@section('title')
<title>{{ $website_lang->where('lang_key','topbar_contact')->first()->custom_lang }}</title>
@endsection
@section('admin-content')
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $website_lang->where('lang_key','topbar_contact')->first()->custom_lang }}</h6>
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.contact-us.update',$contact->id) }}" method="POST">
                        @csrf
                        @method('patch')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">{{ $website_lang->where('lang_key','email')->first()->custom_lang }}</label>
                                    <input type="text" name="email" class="form-control" id="email"  value="{{ $contact->email }}">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">{{ $website_lang->where('lang_key','phone')->first()->custom_lang }}</label>
                                    <input type="text" name="phone" class="form-control" id="phone"  value="{{ $contact->phone }}">

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="facebook">{{ $website_lang->where('lang_key','facebook')->first()->custom_lang }}</label>
                                    <input type="text" name="facebook" class="form-control" id="facebook"  value="{{ $contact->facebook }}">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="twitter">{{ $website_lang->where('lang_key','twitter')->first()->custom_lang }}</label>
                                    <input type="text" name="twitter" class="form-control" id="twitter"  value="{{ $contact->twitter }}">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pinterest">{{ $website_lang->where('lang_key','pinterest')->first()->custom_lang }}</label>
                                    <input type="text" name="pinterest" class="form-control" id="pinterest"  value="{{ $contact->pinterest }}">

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="linkedin">{{ $website_lang->where('lang_key','linkedin')->first()->custom_lang }}</label>
                                    <input type="text" name="linkedin" class="form-control" id="linkedin"  value="{{ $contact->linkedin }}">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="youtube">{{ $website_lang->where('lang_key','youtube')->first()->custom_lang }}</label>
                                    <input type="text" name="youtube" class="form-control" id="youtube"  value="{{ $contact->youtube }}">

                                </div>
                            </div>
                        </div>


                        <button type="submit" class="btn btn-success">{{ $website_lang->where('lang_key','youtube')->first()->custom_lang }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
