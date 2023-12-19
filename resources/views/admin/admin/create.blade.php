@extends('layouts.admin.layout')
@section('title')
<title>{{ $website_lang->where('lang_key','admin')->first()->custom_lang }}</title>
@endsection
@section('admin-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><a href="{{ route('admin.admin-list.index') }}" class="btn btn-primary"><i class="fas fa-list" aria-hidden="true"></i> {{ $website_lang->where('lang_key','all_admin')->first()->custom_lang }} </a></h1>
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $website_lang->where('lang_key','admin')->first()->custom_lang }}</h6>
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.admin-list.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">{{ $website_lang->where('lang_key','name')->first()->custom_lang }}</label>
                            <input type="text" name="name" class="form-control" id="name">
                        </div>
                        <div class="form-group">
                            <label for="email">{{ $website_lang->where('lang_key','email')->first()->custom_lang }}</label>
                            <input type="email" name="email" class="form-control" id="email">
                        </div>
                         <div class="form-group">
                            <label for="password">{{ $website_lang->where('lang_key','password')->first()->custom_lang }}</label>
                            <input type="password" name="password" class="form-control" id="password">
                        </div>

                        <div class="form-group">
                            <label for="status">{{ $website_lang->where('lang_key','status')->first()->custom_lang }}</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1">{{ $website_lang->where('lang_key','active')->first()->custom_lang }}</option>
                                <option value="0">{{ $website_lang->where('lang_key','inactive')->first()->custom_lang }}</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-success">{{ $website_lang->where('lang_key','save')->first()->custom_lang }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
