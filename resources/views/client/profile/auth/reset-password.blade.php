@extends('layouts.client.layout')
@section('title')
<title>{{ $navigation->reset_password }}</title>
@endsection
@section('client-content')


<!--Banner Start-->
<div class="banner-area flex" style="background-image:url({{ $banner->login ? url($banner->login) : '' }});">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="banner-text">
                    <h1>{{ $navigation->reset_password }}</h1>
                    <ul>
                        <li><a href="{{ url('/') }}">{{ $navigation->home }}</a></li>
                        <li><span>{{ $navigation->reset_password }}</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Banner End-->

<!--Register Start-->
<div class="register-area pt_70 pb_70">
	<div class="container wow fadeIn">
		<div class="row">
            @if ($setting->text_direction=='RTL')
            <div class="col-lg-3"></div>
            @endif
			<div class="offset-lg-3 col-lg-6 offset-lg-3">
				<div class="regiser-form login-form">
					<form action="{{ route('store.reset.password',$token) }}" method="POST">
                        @csrf
						<div class="form-row row">
							<div class="form-group col-12">
								<label for="email">{{ $website_lang->where('lang_key','email')->first()->custom_lang }}</label>
								<input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}">
							</div>

							<div class="form-group col-12">
								<label for="password">{{ $website_lang->where('lang_key','password')->first()->custom_lang }}</label>
								<input type="password" name="password" class="form-control" id="password">
							</div>
                            <div class="form-group col-12">
								<label for="password-confirmation">{{ $website_lang->where('lang_key','confirm_pass')->first()->custom_lang }}</label>
								<input type="password" name="password_confirmation" class="form-control" id="password-confirmation">
							</div>
                            @if ($setting->allow_captcha==1)
                            <div class="form-group col-12">
                                <div class="g-recaptcha" data-sitekey="{{ $setting->captcha_key }}"></div>
                            </div>
                            @endif

							<div class="form-group col-12">
								<button type="submit" class="btn btn-primary">{{ $website_lang->where('lang_key','reset_pass')->first()->custom_lang }}</button>
							</div>
						</div>
					</form>

					<a href="{{ url('login') }}" class="link">{{ $website_lang->where('lang_key','login_here')->first()->custom_lang }}</a>

				</div>
			</div>
		</div>
	</div>
</div>
<!--Register End-->

@endsection
