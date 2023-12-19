@extends('layouts.admin.layout')
@section('title')
<title>{{ $website_lang->where('lang_key','contact_msg')->first()->custom_lang }}</title>
@endsection
@section('admin-content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $website_lang->where('lang_key','contact_msg')->first()->custom_lang }}</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="5%">{{ $website_lang->where('lang_key','serial')->first()->custom_lang }}</th>
                            <th width="20%">{{ $website_lang->where('lang_key','name')->first()->custom_lang }}</th>
                            <th width="20%">{{ $website_lang->where('lang_key','email')->first()->custom_lang }}</th>
                            <th width="20%">{{ $website_lang->where('lang_key','phone')->first()->custom_lang }}</th>
                            <th width="20%">{{ $website_lang->where('lang_key','subject')->first()->custom_lang }}</th>
                            <th width="5%">{{ $website_lang->where('lang_key','action')->first()->custom_lang }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($messages as $index => $item)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ $item->subject }}</td>
                            <td>
                                <a href="#" data-toggle="modal" data-target="#viewMessage-{{ $item->id }}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>



    @foreach ($messages as $item)
    <!-- Modal -->
    <div class="modal fade" id="viewMessage-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title">{{ $website_lang->where('lang_key','msg_from')->first()->custom_lang }} {{ $item->name }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        {{ $item->message }}
                    </div>
                </div>

            </div>
        </div>
    </div>


    @endforeach
@endsection
