@include('layouts.admin.header')
<body id="page-top" class="body_bg">
<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg mt_100">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image" style="background-image:url({{ $image->lawyer_login ? url($image->lawyer_login) :'' }});"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">{{ $website_lang->where('lang_key','lawyer_login')->first()->custom_lang }}</h1>
                                </div>
                                <form class="user" action="{{ route('lawyer.login') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control form-control-user"
                                            id="exampleInputEmail" aria-describedby="emailHelp"
                                            placeholder="{{ $website_lang->where('lang_key','email')->first()->custom_lang }}">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="{{ $website_lang->where('lang_key','password')->first()->custom_lang }}">
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        {{ $website_lang->where('lang_key','login')->first()->custom_lang }}
                                    </button>
                                    <hr>
                                </form>
                                <div class="text-center">
                                    <a class="small" href="{{ route('lawyer.forget.password') }}">{{ $website_lang->where('lang_key','forget_pass')->first()->custom_lang }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
</body>
@include('layouts.admin.footer')

