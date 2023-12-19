@extends('layouts.admin.layout')
@section('title')
<title>{{ $website_lang->where('lang_key','website_lang')->first()->custom_lang }}</title>
@endsection
@section('admin-content')
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-10">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $website_lang->where('lang_key','website_lang')->first()->custom_lang }}</h6>
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.update.text') }}" method="post">
                    @csrf
                        <table class="table table-bordered">

                            @foreach ($manageTexts  as $manageText)
                            <tr>
                                <td width="50%">{{ ucwords($manageText->default_lang) }}</td>
                                <td width="50%"><input type="text" name="customs[]" value="{{ $manageText->custom_lang }}" class="form-control"></td>
                                <input type="hidden" name="ids[]" value="{{ $manageText->id }}">
                                <input type="hidden" name="defaults[]" value="{{ $manageText->default_lang }}">
                            </tr>
                            @endforeach


                        </table>
                        <button type="submit" class="btn btn-success">{{ $website_lang->where('lang_key','update')->first()->custom_lang }}</button>
                </div>
            </form>
            </div>
        </div>
    </div>
@endsection
