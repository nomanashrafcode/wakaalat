@extends('layouts.admin.layout')
@section('title')
<title>{{ $website_lang->where('lang_key','mail_for')->first()->custom_lang }}</title>
@endsection
@section('admin-content')
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $website_lang->where('lang_key','mail_for')->first()->custom_lang }}</h6>
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.send.subscriber.mail') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">{{ $website_lang->where('lang_key','subject')->first()->custom_lang }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" value="" name="subject">
                        </div>
                        <div class="form-group">
                            <label for="">{{ $website_lang->where('lang_key','message')->first()->custom_lang }} <span class="text-danger">*</span></label>
                            <textarea name="message" cols="30" rows="10" class="form-control summernote"></textarea>
                        </div>

                        <button class="btn btn-success" type="submit">{{ $website_lang->where('lang_key','send_mail')->first()->custom_lang }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

