@extends('layouts.lawyer.layout')
@section('title')
<title>{{ $website_lang->where('lang_key','setting')->first()->custom_lang }}</title>
@endsection
@section('lawyer-content')
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $website_lang->where('lang_key','setting')->first()->custom_lang }}</h6>
                </div>
                <div class="card-body">
                    <p>Redirect url = {{ route('lawyer.callback-zoom-meeting') }}</p>
                    @if (!$credential)
                    <form action="{{ route('lawyer.store-zoom-credential') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="zoom_api_key">{{ $website_lang->where('lang_key','client_id')->first()->custom_lang }}</label>
                            <input type="text" class="form-control" name="zoom_api_key" id="zoom_api_key">
                        </div>



                        <div class="form-group">
                            <label for="zoom_api_secret">{{ $website_lang->where('lang_key','client_secret')->first()->custom_lang }}</label>
                            <input type="text" class="form-control" name="zoom_api_secret" id="zoom_api_secret">
                        </div>


                        <button type="submit" class="btn btn-success">{{ $website_lang->where('lang_key','save')->first()->custom_lang }}</button>
                    </form>
                    @else
                        <form action="{{ route('lawyer.update-zoom-credential',$credential->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="zoom_api_key">{{ $website_lang->where('lang_key','client_id')->first()->custom_lang }}</label>
                                <input type="text" class="form-control" name="zoom_api_key" id="zoom_api_key" value="{{ $credential->zoom_api_key }}">
                            </div>



                            <div class="form-group">
                                <label for="zoom_api_secret">{{ $website_lang->where('lang_key','client_secret')->first()->custom_lang }}</label>
                                <input type="text" class="form-control" name="zoom_api_secret" id="zoom_api_secret" value="{{ $credential->zoom_api_secret }}">
                            </div>


                            <button type="submit" class="btn btn-success">{{ $website_lang->where('lang_key','update')->first()->custom_lang }}</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
