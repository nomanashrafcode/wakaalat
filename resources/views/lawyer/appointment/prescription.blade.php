@extends('layouts.lawyer.layout')
@section('title')
<title>{{ $website_lang->where('lang_key','prescription')->first()->custom_lang }}</title>
@endsection
@section('lawyer-content')
<div class="card shadow mb-4">
    <div class="card-body" id="search-particular-appointment">
        <div class="prescription">
            <div class="top">
                <div class="row">
                    <div class="col-md-6">
                        <div class="logo"><img src="{{ url($setting->logo) }}" alt=""></div>
                        @if ( $lawyer->prescription_address)
                            <div class="address">
                                <i class="fas fa-map-marker-alt"></i> {{ $lawyer->prescription_address }}
                            </div>
                        @endif

                        @if ($lawyer->prescription_phone)
                        <div class="phone">
                            <i class="fas fa-phone"></i> {{ $lawyer->prescription_phone }}
                        </div>
                        @endif

                        @if ($lawyer->prescription_email)
                        <div class="email">
                            <i class="far fa-envelope"></i>  {{ $lawyer->prescription_email }}
                        </div>
                        @endif

                    </div>
                    <div class="col-md-6">
                        <div class="right">
                            <h2>{{ $appointment->lawyer->name }}</h2>
                            <p>
                                {{ $appointment->lawyer->designations }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="patient-info">
                <div class="row">
                    <div class="col-md-6">
                        {{ $website_lang->where('lang_key','name')->first()->custom_lang }}: {{ $appointment->user->name }}
                    </div>
                    <div class="col-md-3">
                        {{ $website_lang->where('lang_key','email')->first()->custom_lang }}: {{ $appointment->user->email }} Years
                    </div>
                    <div class="col-md-3 text-right">
                        {{ $website_lang->where('lang_key','date')->first()->custom_lang }}: {{ date('m-d-Y',strtotime($appointment->date)) }}
                    </div>
                </div>
            </div>


            <div class="mt-3">
                <form action="{{ route('lawyer.meeting-store',$appointment->id) }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">{{ $website_lang->where('lang_key','subject')->first()->custom_lang }}</label>
                        <input type="text" name="subject" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">{{ $website_lang->where('lang_key','description')->first()->custom_lang }}</label>
                        <textarea name="description" class="summernote"></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div id="addRow">
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="">{{ $website_lang->where('lang_key','document')->first()->custom_lang }}</label>
                                            <input type="file" name="documents[]" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3 btn-row">
                                        <button type="button" id="addLawyerFile" class="btn btn-success" ><i class="fas fa-plus" aria-hidden="true"></i></button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <button class="btn btn-success" type="submit">{{ $website_lang->where('lang_key','save')->first()->custom_lang }}</button>
                </form>
            </div>


        </div>
    </div>
</div>


<script>
	(function($) {
    "use strict";
        // add custom image input field for service section
        $("#addLawyerFile").on('click',function () {
            var html = '';
            html+='<div class="row" id="remove">';
            html+='<div class="col-md-9">';
            html+='<div class="form-group">';
            html+='<label for="">{{ $website_lang->where("lang_key","document")->first()->custom_lang }}</label>';
            html+='<input type="file" name="documents[]" class="form-control">';
            html+='</div>';
            html+='</div>';
            html+='<div class="col-md-3 btn-row">';
            html+='<button class="btn btn-danger" type="button" id="removeImageRow" ><i class="fas fa-trash" aria-hidden="true"></button>';
            html+='</div>';
            html+='</div>';
            $("#addRow").append(html)
        });

        // remove custom image input field row
        $(document).on('click', '#removeImageRow', function () {
            $(this).closest('#remove').remove();
        });

	})(jQuery);
    </script>
@endsection
