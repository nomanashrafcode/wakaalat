@extends('layouts.admin.layout')
@section('title')
<title>Database generate</title>
@endsection
@section('admin-content')
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Database generate</h6>
                </div>
                <div class="card-body">

                    <div class="alert alert-warning" role="alert">
                        <p>{{__('This feature not a regular feature, this will be use for version update. You can not trigger the button as your mind. When need to trigger the button we will mention on our version documentation')}}</p>
                      </div>

                    <a onclick="return confirm('are you sure ?')" href="{{ route('admin.database-regenerate') }}" type="submit" class="btn btn-success">Database generate</a>

                </div>
            </div>
        </div>
    </div>

@endsection



