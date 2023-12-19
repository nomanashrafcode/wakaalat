@extends('layouts.admin.layout')
@section('title')
<title>{{ $website_lang->where('lang_key','subscirber')->first()->custom_lang }}</title>
@endsection
@section('admin-content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $website_lang->where('lang_key','subscriber_table')->first()->custom_lang }}</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>{{ $website_lang->where('lang_key','serial')->first()->custom_lang }}</th>
                            <th>{{ $website_lang->where('lang_key','email')->first()->custom_lang }}</th>
                            <th>{{ $website_lang->where('lang_key','status')->first()->custom_lang }}</th>
                            <th>{{ $website_lang->where('lang_key','action')->first()->custom_lang }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subscribers as $index => $item)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{ $item->email }}</td>
                            <td>
                                @if ($item->status)
                                    <span class="badge badge-success">{{ $website_lang->where('lang_key','verified')->first()->custom_lang }}</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.subscriber.delete',$item->id) }}" onclick="return confirm('{{ $website_lang->where('lang_key','are_you_sure')->first()->custom_lang }}')"class="btn btn-danger btn-sm"><i class="fas fa-trash    "></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

