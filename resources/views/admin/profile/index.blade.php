@extends('layouts.admin.layout')
@section('title')
<title>{{ $website_lang->where('lang_key','profile')->first()->custom_lang }}</title>
@endsection
@section('admin-content')
       <!-- DataTales Example -->
       <div class="row">
           <div class="col-md-6">
               <div class="card shadow mb-4">
                   <div class="card-header py-3">
                       <h6 class="m-0 font-weight-bold text-primary">{{ $website_lang->where('lang_key','profile')->first()->custom_lang }}</h6>
                   </div>
                   <div class="card-body">
                       @if (Session::has('update-profile'))
                           <p class="alert alert-success">{{ Session::get('update-profile') }}</p>
                       @endif
                    <form action="{{ route('admin.update.profile') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">{{ $website_lang->where('lang_key','exist_image')->first()->custom_lang }}</label>
                            @if ($admin->image)
                            <img class="img-thumbnail ml-3" src="{{ url($admin->image) }}" alt="default user image" width="100px">
                            <input type="hidden" name="old_image" value="{{ $admin->image }}">
                            @else
                            <img class="img-thumbnail ml-3" src="{{ url($default_profile->default_profile) }}" alt="default user image" width="100px">
                            <input type="hidden" name="old_image" value="default-user.jpg">
                            @endif

                        </div>
                        <div class="form-group">
                            <label for="">{{ $website_lang->where('lang_key','new_image')->first()->custom_lang }}</label>
                            <input type="file" class="form-control-file" name="image">
                        </div>
                        <div class="form-group">
                            <label for="">{{ $website_lang->where('lang_key','name')->first()->custom_lang }}</label>
                            <input type="text" class="form-control" value="{{ ucfirst($admin->name) }}" name="name">

                        </div>
                        <div class="form-group">
                            <label for="">{{ $website_lang->where('lang_key','email')->first()->custom_lang }}</label>
                            <input type="text" class="form-control" value="{{ $admin->email }}" name="email">

                        </div>

                        <div class="form-group">
                            <label for="">{{ $website_lang->where('lang_key','password')->first()->custom_lang }}</label>
                            <input  type="password" class="form-control" name="password">

                        </div>
                        <div class="form-group">
                            <label for="">{{ $website_lang->where('lang_key','confirm_pass')->first()->custom_lang }}</label>
                            <input type="password" class="form-control" name="password_confirmation">
                        </div>
                        <button class="btn btn-success" type="submit">{{ $website_lang->where('lang_key','update')->first()->custom_lang }}</button>
                    </form>
                   </div>
               </div>
           </div>
       </div>
@endsection
