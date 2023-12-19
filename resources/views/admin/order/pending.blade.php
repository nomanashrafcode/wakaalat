@extends('layouts.admin.layout')
@section('title')
<title>{{ $website_lang->where('lang_key','pending_order')->first()->custom_lang }}</title>
@endsection
@section('admin-content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $website_lang->where('lang_key','pending_order_table')->first()->custom_lang }}</h6>
        </div>
        <div class="card-body" id="search-appointment">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="5%">{{ $website_lang->where('lang_key','serial')->first()->custom_lang }}</th>
                            <th width="15%">{{ $website_lang->where('lang_key','name')->first()->custom_lang }}</th>
                            <th width="15%">{{ $website_lang->where('lang_key','email')->first()->custom_lang }}</th>
                            <th width="15%">{{ $website_lang->where('lang_key','phone')->first()->custom_lang }}</th>
                            <th width="15%">{{ $website_lang->where('lang_key','order_id')->first()->custom_lang }}</th>
                            <th width="15%">{{ $website_lang->where('lang_key','date')->first()->custom_lang }}</th>
                            <th width="5%">{{ $website_lang->where('lang_key','payment')->first()->custom_lang }}</th>
                            <th width="10%">{{ $website_lang->where('lang_key','action')->first()->custom_lang }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $index => $item)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{ ucfirst($item->user->name) }}</td>
                            <td>{{ $item->user->email }}</td>
                            <td>{{ $item->user->phone }}</td>
                            <td>{{ $item->order_id }}</td>
                            <td>{{ $item->created_at->format('m-d-Y') }}</td>
                            <td>
                                @if ($item->payment_status==0)
                                        <span class="badge badge-danger">{{ $website_lang->where('lang_key','pending')->first()->custom_lang }}</span>
                                    @else
                                    <span class="badge badge-success">{{ $website_lang->where('lang_key','success')->first()->custom_lang }}</span>
                                    @endif
                            </td>
                            <td>
                                <a  href="{{ route('admin.show.order',$item->id) }}" class="btn btn-success btn-sm"><i class="fas fa-eye"></i></a>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

