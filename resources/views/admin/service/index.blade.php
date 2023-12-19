@extends('layouts.admin.layout')
@section('title')
<title>{{ $website_lang->where('lang_key','service')->first()->custom_lang }}</title>
@endsection
@section('admin-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><a href="{{ route('admin.service.create') }}" class="btn btn-primary"><i class="fas fa-plus" aria-hidden="true"></i> {{ $website_lang->where('lang_key','create')->first()->custom_lang }} </a></h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $website_lang->where('lang_key','service_table')->first()->custom_lang }}</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="5%">{{ $website_lang->where('lang_key','serial')->first()->custom_lang }}</th>
                            <th width="20%">{{ $website_lang->where('lang_key','name')->first()->custom_lang }}</th>
                            <th width="20%">{{ $website_lang->where('lang_key','slug')->first()->custom_lang }}</th>
                            <th width="15%">{{ $website_lang->where('lang_key','others')->first()->custom_lang }}</th>
                            <th width="10%">{{ $website_lang->where('lang_key','status')->first()->custom_lang }}</th>
                            <th width="20%">{{ $website_lang->where('lang_key','action')->first()->custom_lang }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($services as $index => $item)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{ $item->header }}</td>
                            <td>{{ $item->slug }}</td>
                            <td>
                                <a href="{{ route('admin.service.images',$item->id) }}">{{ $website_lang->where('lang_key','manage_img')->first()->custom_lang }}</a>
                                <a href="{{ route('admin.service-video.index') }}">{{ $website_lang->where('lang_key','manage_video')->first()->custom_lang }}</a>
                                <a href="{{ route('admin.faq.by.service',$item->id) }}">{{ $website_lang->where('lang_key','manage_faq')->first()->custom_lang }}</a>
                            </td>

                            <td>
                                @if ($item->status==1)
                                <a href="" onclick="serviceStatus({{ $item->id }})"><input type="checkbox" checked data-toggle="toggle" data-on="{{ $website_lang->where('lang_key','active')->first()->custom_lang }}" data-off="{{ $website_lang->where('lang_key','inactive')->first()->custom_lang }}" data-onstyle="success" data-offstyle="danger"></a>
                                @else
                                    <a href="" onclick="serviceStatus({{ $item->id }})"><input type="checkbox" data-toggle="toggle" data-on="{{ $website_lang->where('lang_key','active')->first()->custom_lang }}" data-off="{{ $website_lang->where('lang_key','inactive')->first()->custom_lang }}" data-onstyle="success" data-offstyle="danger"></a>

                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.service.edit',$item->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                <a target="_blank" href="{{ url('service-details/'.$item->slug) }}" class="btn btn-success btn-sm"><i class="fas fa-eye"></i></a>
                                <a data-toggle="modal" data-target="#deleteModal" href="javascript:;" onclick="deleteData({{ $item->id }})" class="btn btn-danger btn-sm"><i class="fas fa-trash    "></i></a>

                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function deleteData(id){
            $("#deleteForm").attr("action",'{{ url("admin/service/") }}'+"/"+id)
        }

        function serviceStatus(id){
            // project demo mode check
         var isDemo="{{ env('PROJECT_MODE') }}"
         var demoNotify="{{ env('NOTIFY_TEXT') }}"
         if(isDemo==0){
             toastr.error(demoNotify);
             return;
         }
         // end
            $.ajax({
                type:"get",
                url:"{{url('/admin/service-status/')}}"+"/"+id,
                success:function(response){
                   toastr.success(response)
                },
                error:function(err){
                    console.log(err);

                }
            })
        }
    </script>
@endsection
