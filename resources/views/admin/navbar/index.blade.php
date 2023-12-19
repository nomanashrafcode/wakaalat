@extends('layouts.admin.layout')
@section('title')
<title>{{ $website_lang->where('lang_key','navigation')->first()->custom_lang }}</title>
@endsection
@section('admin-content')
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $website_lang->where('lang_key','navigation')->first()->custom_lang }}</h6>
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.update.navigation') }}" method="POST">
                        @csrf
                    <table class="table table-bordered">
                        <tr>
                            <td>{{ $website_lang->where('lang_key','home_page')->first()->custom_lang }}</td>
                            <td><input type="text" required class="form-control" name="home" value="{{ $navigation->home }}"></td>
                        </tr>
                        <tr>
                            <td>{{ $website_lang->where('lang_key','about_us')->first()->custom_lang }}</td>
                            <td><input type="text" required class="form-control" name="about_us" value="{{ $navigation->about_us }}"></td>
                        </tr>
                        <tr>
                            <td>{{ $website_lang->where('lang_key','pages')->first()->custom_lang }}</td>
                            <td><input type="text" required class="form-control" name="pages" value="{{ $navigation->pages }}"></td>
                        </tr>
                        <tr>
                            <td>{{ $website_lang->where('lang_key','lawyer_page')->first()->custom_lang }}</td>
                            <td><input type="text" required class="form-control" name="lawyer" value="{{ $navigation->lawyer }}"></td>
                        </tr>
                        <tr>
                            <td>{{ $website_lang->where('lang_key','service_page')->first()->custom_lang }}</td>
                            <td><input type="text" required class="form-control" name="service" value="{{ $navigation->service }}"></td>
                        </tr>
                        <tr>
                            <td>{{ $website_lang->where('lang_key','department_page')->first()->custom_lang }}</td>
                            <td><input type="text" required class="form-control" name="department" value="{{ $navigation->department }}"></td>
                        </tr>
                        <tr>
                            <td>{{ $website_lang->where('lang_key','faq_page')->first()->custom_lang }}</td>
                            <td><input type="text" required class="form-control" name="faq" value="{{ $navigation->faq }}"></td>
                        </tr>
                        <tr>
                            <td>{{ $website_lang->where('lang_key','testimonial_page')->first()->custom_lang }}</td>
                            <td><input type="text" required class="form-control" name="testimonial" value="{{ $navigation->testimonial }}"></td>
                        </tr>
                        <tr>
                            <td>{{ $website_lang->where('lang_key','blog_page')->first()->custom_lang }}</td>
                            <td><input type="text" required class="form-control" name="blog" value="{{ $navigation->blog }}"></td>
                        </tr>
                        <tr>
                            <td>{{ $website_lang->where('lang_key','contact_us_page')->first()->custom_lang }}</td>
                            <td><input type="text" required class="form-control" name="contact_us" value="{{ $navigation->contact_us }}"></td>
                        </tr>
                        <tr>
                            <td>{{ $website_lang->where('lang_key','appointment')->first()->custom_lang }}</td>
                            <td><input type="text" required class="form-control" name="appointment" value="{{ $navigation->appointment }}"></td>
                        </tr>
                        <tr>
                            <td>{{ $website_lang->where('lang_key','dashboard')->first()->custom_lang }}</td>
                            <td><input type="text" required class="form-control" name="dashboard" value="{{ $navigation->dashboard }}"></td>
                        </tr>
                        <tr>
                            <td>{{ $website_lang->where('lang_key','payment')->first()->custom_lang }}</td>
                            <td><input type="text" required class="form-control" name="payment" value="{{ $navigation->payment }}"></td>
                        </tr>
                        <tr>
                            <td>{{ $website_lang->where('lang_key','login')->first()->custom_lang }}</td>
                            <td><input type="text" required class="form-control" name="login" value="{{ $navigation->login }}"></td>
                        </tr>
                        <tr>
                            <td>{{ $website_lang->where('lang_key','register')->first()->custom_lang }}</td>
                            <td><input type="text" required class="form-control" name="register" value="{{ $navigation->register }}"></td>
                        </tr>
                        <tr>
                            <td>{{ $website_lang->where('lang_key','terms_and_cond')->first()->custom_lang }}</td>
                            <td><input type="text" required class="form-control" name="terms_and_condition" value="{{ $navigation->terms_and_condition }}"></td>
                        </tr>
                        <tr>
                            <td>{{ $website_lang->where('lang_key','privacy_policy')->first()->custom_lang }}</td>
                            <td><input type="text" required class="form-control" name="privacy_policy" value="{{ $navigation->privacy_policy }}"></td>
                        </tr>
                        <tr>
                            <td>{{ $website_lang->where('lang_key','forget_password')->first()->custom_lang }}</td>
                            <td><input type="text" required class="form-control" name="forget_password" value="{{ $navigation->forget_password }}"></td>
                        </tr>
                        <tr>
                            <td>{{ $website_lang->where('lang_key','reset_password')->first()->custom_lang }}</td>
                            <td><input type="text" required class="form-control" name="reset_password" value="{{ $navigation->reset_password }}"></td>
                        </tr>
                    </table>
                    <button type="submit" class="btn btn-success">{{ $website_lang->where('lang_key','update')->first()->custom_lang }}</button>
                </div>
            </form>
            </div>
        </div>
    </div>




@endsection
