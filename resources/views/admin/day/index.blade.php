@extends('layouts.admin.layout')
@section('title')
<title>{{ $website_lang->where('lang_key','day')->first()->custom_lang }}</title>
@endsection
@section('admin-content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $website_lang->where('lang_key','day_table')->first()->custom_lang }}</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>{{ $website_lang->where('lang_key','serial')->first()->custom_lang }}</th>
                            <th >{{ $website_lang->where('lang_key','default_day')->first()->custom_lang }}</th>
                            <th >{{ $website_lang->where('lang_key','custom_day')->first()->custom_lang }}</th>
                            <th >{{ $website_lang->where('lang_key','action')->first()->custom_lang }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($days as $index => $item)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{ $item->day }}</td>
                            <td>{{ $item->custom_day }}</td>
                            <td>
                                <a data-toggle="modal" data-target="#edit-day-{{ $item->id }}" class="btn btn-primary btn-sm custom_danger_btn"><i class="fas fa-edit    "></i></a>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>


    @foreach ($days as $item)
    <!-- Modal -->
    <div class="modal fade" id="edit-day-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title">{{ $website_lang->where('lang_key','day_form')->first()->custom_lang }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form action="{{ route('admin.day.update',$item->id) }}" method="POST">
                            @csrf
                            @method('patch')
                            <div class="form-group">
                                <label for="">{{ $website_lang->where('lang_key','default_day')->first()->custom_lang }}</label>
                                <input type="text" value="{{ $item->day }}" readonly class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">{{ $website_lang->where('lang_key','custom_day')->first()->custom_lang }}</label>
                                <input type="text" value="{{ $item->custom_day }}" name="custom_day" class="form-control" required>

                            </div>

                            <button type="button" class="btn btn-danger" data-dismiss="modal">{{ $website_lang->where('lang_key','close')->first()->custom_lang }}</button>
                        <button type="submit" class="btn btn-primary">{{ $website_lang->where('lang_key','update')->first()->custom_lang }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
@endsection
