@extends('layouts.admin.layout')
@section('title')
<title>{{ $website_lang->where('lang_key','home_page')->first()->custom_lang }}</title>
@endsection
@section('admin-content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        @php
            $feature_section=$sections->where('id',1)->first();
        @endphp
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $website_lang->where('lang_key','home_page')->first()->custom_lang }} {{ ucwords($feature_section->section_name) }}</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.home-section.update',$feature_section->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="content_quantity">{{ $website_lang->where('lang_key','content_qty')->first()->custom_lang }}</label>
                            <input type="number" name="content_quantity"  class="form-control" value="{{ $feature_section->content_quantity }}">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="show_homepage">{{ $website_lang->where('lang_key','show_homepage')->first()->custom_lang }}</label>
                            <select name="show_homepage" class="form-control">
                                <option {{ $feature_section->show_homepage==1 ? 'selected':'' }} value="1">{{ $website_lang->where('lang_key','yes')->first()->custom_lang }}</option>
                                <option {{ $feature_section->show_homepage==0 ? 'selected':'' }} value="0">{{ $website_lang->where('lang_key','no')->first()->custom_lang }}</option>
                            </select>
                        </div>
                        <input type="hidden" value="{{ $feature_section->section_type }}" name="section_type">
                    </div>

                </div>


                <button type="submit" class="btn btn-success">{{ $website_lang->where('lang_key','update')->first()->custom_lang }} {{ ucwords($feature_section->section_name) }}</button>
            </form>
        </div>
    </div>

    <div class="card shadow mb-4">
        @php
            $work_section=$sections->where('id',2)->first();
        @endphp
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $website_lang->where('lang_key','home_page')->first()->custom_lang }} {{ ucwords($work_section->section_name) }}</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.home-section.update',$work_section->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="first_header">{{ $website_lang->where('lang_key','first_header')->first()->custom_lang }}</label>
                            <input type="text" class="form-control" name="first_header"  value="{{ $work_section->first_header }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="second_header">{{ $website_lang->where('lang_key','second_header')->first()->custom_lang }}</label>
                            <input type="text" class="form-control" name="second_header"  value="{{ $work_section->second_header }}">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description">{{ $website_lang->where('lang_key','description')->first()->custom_lang }}</label>
                            <textarea class="form-control" cols="30" rows="5"   name="description">{{ $work_section->description }}</textarea>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="show_homepage">{{ $website_lang->where('lang_key','show_homepage')->first()->custom_lang }}</label>
                            <select name="show_homepage"  class="form-control">
                                <option {{ $work_section->show_homepage==1 ? 'selected':'' }} value="1">{{ $website_lang->where('lang_key','yes')->first()->custom_lang }}</option>
                                <option {{ $work_section->show_homepage==0 ? 'selected':'' }} value="0">{{ $website_lang->where('lang_key','no')->first()->custom_lang }}</option>
                            </select>
                        </div>
                        <input type="hidden" value="{{ $work_section->section_type }}" name="section_type">
                    </div>

                </div>
                <button type="submit" class="btn btn-success">{{ $website_lang->where('lang_key','update')->first()->custom_lang }} {{ ucwords($work_section->section_name) }}</button>
            </form>
        </div>
    </div>

    <div class="card shadow mb-4">
        @php
            $service_section=$sections->where('id',3)->first();
        @endphp
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $website_lang->where('lang_key','home_page')->first()->custom_lang }} {{ ucwords($service_section->section_name) }}</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.home-section.update',$service_section->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="first_header">{{ $website_lang->where('lang_key','first_header')->first()->custom_lang }}</label>
                            <input type="text" class="form-control" name="first_header"  value="{{ $service_section->first_header }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="second_header">{{ $website_lang->where('lang_key','second_header')->first()->custom_lang }}</label>
                            <input type="text" class="form-control" name="second_header"  value="{{ $service_section->second_header }}">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description">{{ $website_lang->where('lang_key','description')->first()->custom_lang }}</label>
                            <textarea class="form-control" cols="30" rows="5"   name="description">{{ $service_section->description }}</textarea>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="content_quantity">{{ $website_lang->where('lang_key','content_qty')->first()->custom_lang }}</label>
                            <input type="number" name="content_quantity"  class="form-control" value="{{ $service_section->content_quantity }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="show_homepage">{{ $website_lang->where('lang_key','show_homepage')->first()->custom_lang }}</label>
                            <select name="show_homepage" class="form-control">
                                <option {{ $service_section->show_homepage==1 ? 'selected':'' }} value="1">{{ $website_lang->where('lang_key','yes')->first()->custom_lang }}</option>
                                <option {{ $service_section->show_homepage==0 ? 'selected':'' }} value="0">{{ $website_lang->where('lang_key','no')->first()->custom_lang }}</option>
                            </select>
                        </div>
                        <input type="hidden" value="{{ $service_section->section_type }}" name="section_type">
                    </div>

                </div>
                <button type="submit" class="btn btn-success">{{ $website_lang->where('lang_key','update')->first()->custom_lang }} {{ ucwords($service_section->section_name) }}</button>
            </form>
        </div>
    </div>

    <div class="card shadow mb-4">
        @php
            $department_section=$sections->where('id',4)->first();
        @endphp
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $website_lang->where('lang_key','home_page')->first()->custom_lang }} {{ ucwords($department_section->section_name) }}</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.home-section.update',$department_section->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="first_header">{{ $website_lang->where('lang_key','first_header')->first()->custom_lang }}</label>
                            <input type="text" class="form-control" name="first_header"  value="{{ $department_section->first_header }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="second_header">{{ $website_lang->where('lang_key','second_header')->first()->custom_lang }}</label>
                            <input type="text" class="form-control" name="second_header" value="{{ $department_section->second_header }}">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description">{{ $website_lang->where('lang_key','description')->first()->custom_lang }}</label>
                            <textarea class="form-control" cols="30" rows="5"  name="description">{{ $department_section->description }}</textarea>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="content_quantity">{{ $website_lang->where('lang_key','content_qty')->first()->custom_lang }}</label>
                            <input type="number" name="content_quantity" class="form-control" value="{{ $department_section->content_quantity }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="show_homepage">{{ $website_lang->where('lang_key','show_homepage')->first()->custom_lang }}</label>
                            <select name="show_homepage" class="form-control">
                                <option {{ $department_section->show_homepage==1 ? 'selected':'' }} value="1">{{ $website_lang->where('lang_key','yes')->first()->custom_lang }}</option>
                                <option {{ $department_section->show_homepage==0 ? 'selected':'' }} value="0">{{ $website_lang->where('lang_key','no')->first()->custom_lang }}</option>
                            </select>
                        </div>
                        <input type="hidden" value="{{ $department_section->section_type }}" name="section_type">
                    </div>

                </div>
                <button type="submit" class="btn btn-success">{{ $website_lang->where('lang_key','update')->first()->custom_lang }} {{ ucwords($department_section->section_name) }}</button>
            </form>
        </div>
    </div>
    <div class="card shadow mb-4">
        @php
            $client_section=$sections->where('id',5)->first();
        @endphp
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $website_lang->where('lang_key','home_page')->first()->custom_lang }} {{ ucwords($client_section->section_name) }}</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.home-section.update',$client_section->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="first_header">{{ $website_lang->where('lang_key','first_header')->first()->custom_lang }}</label>
                            <input type="text" class="form-control" name="first_header"  value="{{ $client_section->first_header }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="second_header">{{ $website_lang->where('lang_key','second_header')->first()->custom_lang }}</label>
                            <input type="text" class="form-control" name="second_header" value="{{ $client_section->second_header }}">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description">{{ $website_lang->where('lang_key','description')->first()->custom_lang }}</label>
                            <textarea class="form-control" cols="30" rows="5"  name="description">{{ $client_section->description }}</textarea>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="content_quantity">{{ $website_lang->where('lang_key','content_qty')->first()->custom_lang }}</label>
                            <input type="number" name="content_quantity" class="form-control" value="{{ $client_section->content_quantity }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="show_homepage">{{ $website_lang->where('lang_key','show_homepage')->first()->custom_lang }}</label>
                            <select name="show_homepage" class="form-control">
                                <option {{ $client_section->show_homepage==1 ? 'selected':'' }} value="1">{{ $website_lang->where('lang_key','yes')->first()->custom_lang }}</option>
                                <option {{ $client_section->show_homepage==0 ? 'selected':'' }} value="0">{{ $website_lang->where('lang_key','no')->first()->custom_lang }}</option>
                            </select>
                        </div>
                        <input type="hidden" value="{{ $client_section->section_type }}" name="section_type">
                    </div>

                </div>
                <button type="submit" class="btn btn-success">{{ $website_lang->where('lang_key','update')->first()->custom_lang }} {{ ucwords($client_section->section_name) }}</button>
            </form>
        </div>
    </div>

    <div class="card shadow mb-4">
        @php
            $lawyer_section=$sections->where('id',6)->first();
        @endphp
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $website_lang->where('lang_key','home_page')->first()->custom_lang }} {{ ucwords($lawyer_section->section_name) }}</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.home-section.update',$lawyer_section->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="first_header">{{ $website_lang->where('lang_key','first_header')->first()->custom_lang }}</label>
                            <input type="text" class="form-control" name="first_header"  value="{{ $lawyer_section->first_header }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="second_header">{{ $website_lang->where('lang_key','second_header')->first()->custom_lang }}</label>
                            <input type="text" class="form-control" name="second_header" value="{{ $lawyer_section->second_header }}">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description">{{ $website_lang->where('lang_key','description')->first()->custom_lang }}</label>
                            <textarea class="form-control" cols="30" rows="5"  name="description">{{ $lawyer_section->description }}</textarea>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="content_quantity">{{ $website_lang->where('lang_key','content_qty')->first()->custom_lang }}</label>
                            <input type="number" name="content_quantity" class="form-control" value="{{ $lawyer_section->content_quantity }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="show_homepage">{{ $website_lang->where('lang_key','show_homepage')->first()->custom_lang }}</label>
                            <select name="show_homepage" class="form-control">
                                <option {{ $lawyer_section->show_homepage==1 ? 'selected':'' }} value="1">{{ $website_lang->where('lang_key','yes')->first()->custom_lang }}</option>
                                <option {{ $lawyer_section->show_homepage==0 ? 'selected':'' }} value="0">{{ $website_lang->where('lang_key','no')->first()->custom_lang }}</option>
                            </select>
                        </div>
                        <input type="hidden" value="{{ $lawyer_section->section_type }}" name="section_type">
                    </div>

                </div>
                <button type="submit" class="btn btn-success">{{ $website_lang->where('lang_key','update')->first()->custom_lang }} {{ ucwords($lawyer_section->section_name) }}</button>
            </form>
        </div>
    </div>

    <div class="card shadow mb-4">
        @php
            $blog_section=$sections->where('id',7)->first();
        @endphp
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $website_lang->where('lang_key','home_page')->first()->custom_lang }} {{ ucwords($blog_section->section_name) }}</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.home-section.update',$blog_section->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="first_header">{{ $website_lang->where('lang_key','first_header')->first()->custom_lang }}</label>
                            <input type="text" class="form-control" name="first_header"  value="{{ $blog_section->first_header }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="second_header">{{ $website_lang->where('lang_key','second_header')->first()->custom_lang }}</label>
                            <input type="text" class="form-control" name="second_header" value="{{ $blog_section->second_header }}">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description">{{ $website_lang->where('lang_key','description')->first()->custom_lang }}</label>
                            <textarea class="form-control" cols="30" rows="5"  name="description">{{ $blog_section->description }}</textarea>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="content_quantity">{{ $website_lang->where('lang_key','content_qty')->first()->custom_lang }}</label>
                            <input type="number" name="content_quantity" class="form-control" value="{{ $blog_section->content_quantity }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="show_homepage">{{ $website_lang->where('lang_key','show_homepage')->first()->custom_lang }}</label>
                            <select name="show_homepage" class="form-control">
                                <option {{ $blog_section->show_homepage==1 ? 'selected':'' }} value="1">{{ $website_lang->where('lang_key','yes')->first()->custom_lang }}</option>
                                <option {{ $blog_section->show_homepage==0 ? 'selected':'' }} value="0">{{ $website_lang->where('lang_key','no')->first()->custom_lang }}</option>
                            </select>
                        </div>
                        <input type="hidden" value="{{ $blog_section->section_type }}" name="section_type">
                    </div>

                </div>
                <button type="submit" class="btn btn-success">{{ $website_lang->where('lang_key','update')->first()->custom_lang }} {{ ucwords($blog_section->section_name) }}</button>
            </form>
        </div>
    </div>













    <script>
        function deleteData(id){
            $("#deleteForm").attr("action",'{{ url("admin/home-section/") }}'+"/"+id)
        }

        function homseSectionStatus(id){
            $.ajax({
                type:"get",
                url:"{{url('/admin/home-section-status/')}}"+"/"+id,
                success:function(response){
                   toastr.success(response)
                },
                error:function(err){
                    console.log(err);

                }
            })
        }
    </script>
@endsection
