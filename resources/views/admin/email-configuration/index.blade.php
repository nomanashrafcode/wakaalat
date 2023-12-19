@extends('layouts.admin.layout')
@section('title')
<title>{{ $website_lang->where('lang_key','email_config')->first()->custom_lang }}</title>
@endsection
@section('admin-content')
    <div class="row">
        <div class="col-md-10">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $website_lang->where('lang_key','email_config')->first()->custom_lang }}</h6>
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.update-email-configuraion') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">{{ $website_lang->where('lang_key','mail_host')->first()->custom_lang }}</label>
                                <input type="text" name="mail_host" value="{{ $email->mail_host }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">{{ $website_lang->where('lang_key','send_email_from')->first()->custom_lang }}</label>
                                    <input type="email" name="email" value="{{ $email->email }}" class="form-control">
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">{{ $website_lang->where('lang_key','smtp_username')->first()->custom_lang }}</label>
                                    <input type="text" name="smtp_username" value="{{ $email->smtp_username }}" class="form-control">
                                </div>
                            </div>



                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">{{ $website_lang->where('lang_key','smtp_pass')->first()->custom_lang }}</label>
                                    <input type="text" name="smtp_password" value="{{ $email->smtp_password }}" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="mail_port">{{ $website_lang->where('lang_key','mail_port')->first()->custom_lang }}</label>
                                    <input type="text" name="mail_port" value="{{ $email->mail_port }}" class="form-control" id="mail_port">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="mail_encryption">{{ $website_lang->where('lang_key','mail_encryption')->first()->custom_lang }} </label>
                                    <select name="mail_encryption" id="mail_encryption" class="form-control">
                                        <option {{ $email->mail_encryption=='tls' ? 'selected' :'' }} value="tls">{{ $website_lang->where('lang_key','tls')->first()->custom_lang }}</option>
                                        <option {{ $email->mail_encryption=='ssl' ? 'selected' :'' }} value="ssl">{{ $website_lang->where('lang_key','ssl')->first()->custom_lang }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>



                        <button type="submit" class="btn btn-success">{{ $website_lang->where('lang_key','update')->first()->custom_lang }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
