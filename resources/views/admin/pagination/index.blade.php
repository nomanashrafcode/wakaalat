@extends('layouts.admin.layout')
@section('title')
<title>{{ $website_lang->where('lang_key','pagination')->first()->custom_lang }}</title>
@endsection
@section('admin-content')
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-10">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $website_lang->where('lang_key','pagination')->first()->custom_lang }}</h6>
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.pagination-update') }}" method="post">
                    @csrf
                        <table class="table table-bordered">

                            @foreach ($paginators  as $paginator)
                            <tr>
                                <td width="50%">{{ $paginator->page }}</td>
                                <td width="50%"><input type="text" name="qtys[]" value="{{ $paginator->qty }}" class="form-control"></td>
                                <input type="hidden" name="ids[]" value="{{ $paginator->id }}">
                            </tr>
                            @endforeach


                        </table>
                        <button type="submit" class="btn btn-success">{{ $website_lang->where('lang_key','update')->first()->custom_lang }}</button>
                </div>
            </form>
            </div>
        </div>
    </div>
@endsection
