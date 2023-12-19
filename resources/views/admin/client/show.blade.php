@extends('layouts.admin.layout')
@section('title')
<title>{{ $website_lang->where('lang_key','client')->first()->custom_lang }}</title>
@endsection
@section('admin-content')
    <h1><a href="{{ route('admin.clients') }}" class="btn btn-success"><i class="fas fa-list"></i> {{ $website_lang->where('lang_key','all_client')->first()->custom_lang }}</a></h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body" id="search-appointment">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <td>{{ $website_lang->where('lang_key','photo')->first()->custom_lang }}</td>
                            <td>
                                @if ($patient->image)
                                <img class="img-thumbnail" src="{{ url($patient->image) }}" alt="Patient Image" width="100px">
                                @else
                                <img class="img-thumbnail" src="{{ $user_image->default_profile ? url($user_image->default_profile) :'' }}" alt="Patient Image" width="100px">
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>{{ $website_lang->where('lang_key','name')->first()->custom_lang }}</td>
                            <td>{{ $patient->name }}</td>
                        </tr>

                        <tr>
                            <td>{{ $website_lang->where('lang_key','email')->first()->custom_lang }}</td>
                            <td>{{ $patient->email }}</td>
                        </tr>
                        <tr>
                            <td>{{ $website_lang->where('lang_key','total_appointment')->first()->custom_lang }}</td>
                            <td>{{ $patient->appointment->count() }}</td>
                        </tr>

                        <tr>
                            <td>{{ $website_lang->where('lang_key','phone')->first()->custom_lang }}</td>
                            <td>{{ $patient->Phone }}</td>
                        </tr>
                        <tr>
                            <td>{{ $website_lang->where('lang_key','guarding_name')->first()->custom_lang }}</td>
                            <td>{{ $patient->guardian_name }}</td>
                        </tr>
                        <tr>
                            <td>{{ $website_lang->where('lang_key','guardian_phone')->first()->custom_lang }}</td>
                            <td>{{ $patient->guardian_phone }}</td>
                        </tr>
                        <tr>
                            <td>{{ $website_lang->where('lang_key','occupation')->first()->custom_lang }}</td>
                            <td>{{ $patient->occupation }}</td>
                        </tr>
                        <tr>
                            <td>{{ $website_lang->where('lang_key','age')->first()->custom_lang }}</td>
                            <td>{{ $patient->age }}</td>
                        </tr>
                        <tr>
                            <td>{{ $website_lang->where('lang_key','gender')->first()->custom_lang }}</td>
                            <td>{{ $patient->gender }}</td>
                        </tr>


                    </thead>

                </table>
            </div>
        </div>
    </div>
@endsection

