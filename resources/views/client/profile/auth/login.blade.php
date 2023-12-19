@extends('layouts.client.layout')
@section('title')
<title>{{ $navigation->login }}</title>
@endsection
@section('client-content')

<!--Banner Start-->
<div class="banner-area flex" style="background-image:url({{ $banner->login ? url($banner->login) : '' }});">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="banner-text">
                    <h1>{{ $navigation->login }}</h1>
                    <ul>
                        <li><a href="{{ url('/') }}">{{ $navigation->home }}</a></li>
                        <li><span>{{ $navigation->login }}</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Banner End-->

<!--Login Start-->
<div class="login-area pt_70 pb_70">
	<div class="container">
		<div class="row">
            @if ($setting->text_direction=='RTL')
            <div class="col-lg-4"></div>
            @endif
			<div class="offset-lg-4 col-lg-4 offset-lg-4">
				<div class="login-form">
					<form action="{{ route('login') }}" method="post">
                        @csrf
						<div class="form-row row">
							<div class="form-group col-12">
								<label for="email">{{ $website_lang->where('lang_key','email')->first()->custom_lang }}</label>
								<input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
							</div>
							<div class="form-group col-12">
								<label for="password">{{ $website_lang->where('lang_key','password')->first()->custom_lang }}</label>
								<input type="password" name="password" class="form-control" id="password">
							</div>
                            @if ($setting->allow_captcha==1)
                            <div class="form-group col-12">
                                <div class="g-recaptcha" data-sitekey="{{ $setting->captcha_key }}"></div>
                            </div>
                            @endif
							<button type="submit" class="btn btn-primary">{{ $website_lang->where('lang_key','login')->first()->custom_lang }}</button>
						</div>
					</form>
					<div class="mt_20">
						<a href="{{ route('forget.password') }}" class="link">{{ $website_lang->where('lang_key','forget_pass')->first()->custom_lang }}</a><br>
						<a href="{{ route('register') }}" class="link">{{ $website_lang->where('lang_key','client_reg')->first()->custom_lang }}</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--Login End-->

@endsection
