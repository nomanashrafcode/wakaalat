@extends('layouts.admin.layout')
@section('title')
<title>{{ $website_lang->where('lang_key','banner_image')->first()->custom_lang }}</title>
@endsection
@section('admin-content')
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-10">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $website_lang->where('lang_key','banner_image')->first()->custom_lang }}</h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">


                        <tr>
                            <form action="{{ route('admin.about.banner') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <td>{{ $website_lang->where('lang_key','about_us')->first()->custom_lang }}</td>
                            <td><img width="200px" src="{{ $banner->about_us ? url($banner->about_us) :'' }}" alt="about us banner"></td>
                            <td><input  type="file" class="form-control" name="about_us" value=""></td>
                            <td>
                                <button type="submit" class="btn btn-success">{{ $website_lang->where('lang_key','update')->first()->custom_lang }}</button>
                            </td>
                        </form>
                        </tr>

                        <tr>
                            <form action="{{ route('admin.subscribe.us.banner') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <td>{{ $website_lang->where('lang_key','subjscribe_us')->first()->custom_lang }}</td>
                            <td><img width="200px" src="{{ $banner->subscribe_us ? url($banner->subscribe_us) :'' }}" alt="subscribe_us banner"></td>
                            <td><input  type="file" class="form-control" name="subscribe_us" value=""></td>
                            <td>
                                <button type="submit" class="btn btn-success">{{ $website_lang->where('lang_key','update')->first()->custom_lang }}</button>
                            </td>
                        </form>
                        </tr>

                        <tr>
                            <form action="{{ route('admin.doctor.banner') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <td>{{ $website_lang->where('lang_key','lawyer_page')->first()->custom_lang }}</td>
                            <td><img width="200px" src="{{ $banner->lawyer ? url($banner->lawyer) :'' }}" alt="doctor banner"></td>
                            <td><input  type="file" class="form-control" name="lawyer" value=""></td>
                            <td>
                                <button type="submit" class="btn btn-success">{{ $website_lang->where('lang_key','update')->first()->custom_lang }}</button>
                            </td>
                        </form>
                        </tr>
                        <tr>
                            <form action="{{ route('admin.service.banner') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <td>{{ $website_lang->where('lang_key','service_page')->first()->custom_lang }}</td>
                            <td><img width="200px" src="{{ $banner->service ? url($banner->service) :'' }}" alt="service banner"></td>
                            <td><input  type="file" class="form-control" name="service" value=""></td>
                            <td>
                                <button type="submit" class="btn btn-success">{{ $website_lang->where('lang_key','update')->first()->custom_lang }}</button>
                            </td>
                        </form>
                        </tr>
                        <tr>
                            <form action="{{ route('admin.department.banner') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <td>{{ $website_lang->where('lang_key','department_page')->first()->custom_lang }}</td>
                            <td><img width="200px" src="{{ $banner->department ? url($banner->department) :'' }}" alt="department banner"></td>
                            <td><input  type="file" class="form-control" name="department" value=""></td>
                            <td>
                                <button type="submit" class="btn btn-success">{{ $website_lang->where('lang_key','update')->first()->custom_lang }}</button>
                            </td>
                        </form>
                        </tr>
                        <tr>
                            <form action="{{ route('admin.testimonial.banner') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <td>{{ $website_lang->where('lang_key','testimonial_page')->first()->custom_lang }}</td>
                            <td><img width="200px" src="{{ $banner->testimonial ? url($banner->testimonial) :'' }}" alt="testimonial banner"></td>
                            <td><input  type="file" class="form-control" name="testimonial" value=""></td>
                            <td>
                                <button type="submit" class="btn btn-success">{{ $website_lang->where('lang_key','update')->first()->custom_lang }}</button>
                            </td>
                        </form>
                        </tr>
                        <tr>
                            <form action="{{ route('admin.faq.banner') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <td>{{ $website_lang->where('lang_key','faq_page')->first()->custom_lang }}</td>
                            <td><img width="200px" src="{{ $banner->faq ? url($banner->faq) :'' }}" alt="faq banner"></td>
                            <td><input  type="file" class="form-control" name="faq" value=""></td>
                            <td>
                                <button type="submit" class="btn btn-success">{{ $website_lang->where('lang_key','update')->first()->custom_lang }}</button>
                            </td>
                        </form>
                        </tr>
                        <tr>
                            <form action="{{ route('admin.contact.banner') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <td>{{ $website_lang->where('lang_key','contact_us_page')->first()->custom_lang }}</td>
                            <td><img width="200px" src="{{ $banner->contact ? url($banner->contact) :'' }}" alt="contact banner"></td>
                            <td><input  type="file" class="form-control" name="contact" value=""></td>
                            <td>
                                <button type="submit" class="btn btn-success">{{ $website_lang->where('lang_key','update')->first()->custom_lang }}</button>
                            </td>
                        </form>
                        </tr>
                        <tr>
                            <form action="{{ route('admin.profile.banner') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <td>{{ $website_lang->where('lang_key','client_profile')->first()->custom_lang }}</td>
                            <td><img width="200px" src="{{ $banner->profile ? url($banner->profile) :'' }}" alt="profile banner"></td>
                            <td><input  type="file" class="form-control" name="profile" value=""></td>
                            <td>
                                <button type="submit" class="btn btn-success">{{ $website_lang->where('lang_key','update')->first()->custom_lang }}</button>
                            </td>
                        </form>
                        </tr>
                        <tr>
                            <form action="{{ route('admin.login.banner') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <td>{{ $website_lang->where('lang_key','client_auth')->first()->custom_lang }}</td>
                            <td><img width="200px" src="{{ $banner->login ? url($banner->login) :'' }}" alt="login banner"></td>
                            <td><input  type="file" class="form-control" name="login" value=""></td>
                            <td>
                                <button type="submit" class="btn btn-success">{{ $website_lang->where('lang_key','update')->first()->custom_lang }}</button>
                            </td>
                        </form>
                        </tr>
                        <tr>
                            <form action="{{ route('admin.payment.banner') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <td>{{ $website_lang->where('lang_key','client_payment')->first()->custom_lang }}</td>
                            <td><img width="200px" src="{{ $banner->payment ? url($banner->payment) :'' }}" alt="payment banner"></td>
                            <td><input  type="file" class="form-control" name="payment" value=""></td>
                            <td>
                                <button type="submit" class="btn btn-success">{{ $website_lang->where('lang_key','update')->first()->custom_lang }}</button>
                            </td>
                        </form>
                        </tr>
                        <tr>
                            <form action="{{ route('admin.custom_page.banner') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <td>{{ $website_lang->where('lang_key','custom_page')->first()->custom_lang }}</td>
                            <td><img width="200px" src="{{ $banner->custom_page ? url($banner->custom_page) :'' }}" alt="custom_page banner"></td>
                            <td><input  type="file" class="form-control" name="custom_page" value=""></td>
                            <td>
                                <button type="submit" class="btn btn-success">{{ $website_lang->where('lang_key','update')->first()->custom_lang }}</button>
                            </td>
                        </form>
                        </tr>
                        <tr>
                            <form action="{{ route('admin.blog.banner') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <td>{{ $website_lang->where('lang_key','blog_page')->first()->custom_lang }}</td>
                            <td><img width="200px" src="{{ $banner->blog ? url($banner->blog) :'' }}" alt="blog banner"></td>
                            <td><input  type="file" class="form-control" name="blog" value=""></td>
                            <td>
                                <button type="submit" class="btn btn-success">{{ $website_lang->where('lang_key','update')->first()->custom_lang }}</button>
                            </td>
                        </form>
                        </tr>
                        <tr>
                            <form action="{{ route('admin.privacy_and_policy.banner') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <td>{{ $website_lang->where('lang_key','privacy_policy')->first()->custom_lang }}</td>
                            <td><img width="200px" src="{{ $banner->privacy_and_policy ? url($banner->privacy_and_policy) :'' }}" alt="privacy_and_policy banner"></td>
                            <td><input  type="file" class="form-control" name="privacy_and_policy" value=""></td>
                            <td>
                                <button type="submit" class="btn btn-success">{{ $website_lang->where('lang_key','update')->first()->custom_lang }}</button>
                            </td>
                        </form>
                        </tr>
                        <tr>
                            <form action="{{ route('admin.terms_and_condition.banner') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <td>{{ $website_lang->where('lang_key','terms_and_cond')->first()->custom_lang }}</td>
                            <td><img width="200px" src="{{ $banner->terms_and_condition ? url($banner->terms_and_condition) :'' }}" alt="terms_and_condition banner"></td>
                            <td><input  type="file" class="form-control" name="terms_and_condition" value=""></td>
                            <td>
                                <button type="submit" class="btn btn-success">{{ $website_lang->where('lang_key','update')->first()->custom_lang }}</button>
                            </td>
                        </form>
                        </tr>


                        <tr>
                            <form action="{{ route('admin.overview.banner') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <td>{{ $website_lang->where('lang_key','home_overview')->first()->custom_lang }}</td>
                            <td><img width="200px" src="{{ $banner->overview ? url($banner->overview) :'' }}" alt="about us banner"></td>
                            <td><input  type="file" class="form-control" name="overview" value=""></td>
                            <td>
                                <button type="submit" class="btn btn-success">{{ $website_lang->where('lang_key','update')->first()->custom_lang }}</button>
                            </td>
                        </form>
                        </tr>



                    </table>

                </div>
            </div>
        </div>
    </div>




@endsection
