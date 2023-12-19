@extends('layouts.admin.layout')
@section('title')
<title>{{ $website_lang->where('lang_key','schedule')->first()->custom_lang }}</title>
@endsection
@section('admin-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><a href="{{ route('admin.schedule.create') }}" class="btn btn-primary"><i class="fas fa-plus" aria-hidden="true"></i> {{ $website_lang->where('lang_key','create')->first()->custom_lang }} </a></h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $website_lang->where('lang_key','schedule_table')->first()->custom_lang }}</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="5%">{{ $website_lang->where('lang_key','serial')->first()->custom_lang }}</th>
                            <th width="15%">{{ $website_lang->where('lang_key','lawyer')->first()->custom_lang }}</th>
                            <th width="15%">{{ $website_lang->where('lang_key','day')->first()->custom_lang }}</th>
                            <th width="15%">{{ $website_lang->where('lang_key','time')->first()->custom_lang }}</th>
                            <th width="5%">{{ $website_lang->where('lang_key','status')->first()->custom_lang }}</th>
                            <th width="20%">{{ $website_lang->where('lang_key','action')->first()->custom_lang }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($schedules as $index => $item)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{ $item->lawyer->name }}</td>
                            <td>{{ ucfirst($item->day->day) }}</td>
                            <td>{{ strtoupper($item->start_time) }} - {{ strtoupper($item->end_time) }}</td>
                            <td>
                                @if ($item->status==1)
                                <a href="" onclick="scheduleStatus({{ $item->id }})"><input type="checkbox" checked data-toggle="toggle" data-on="Active" data-off="In-Active" data-onstyle="success" data-offstyle="danger"></a>
                                @else
                                    <a href="" onclick="scheduleStatus({{ $item->id }})"><input type="checkbox" data-toggle="toggle" data-on="Active" data-off="In-Active" data-onstyle="success" data-offstyle="danger"></a>

                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.schedule.edit',$item->id) }}" class="btn btn-primary btn-sm custom_danger_btn"><i class="fas fa-edit    "></i></a>
                                @php
                                    $count=$appointments->where('schedule_id',$item->id)->count();
                                @endphp
                                @if ($count==0)
                                <a data-toggle="modal" data-target="#deleteModal" href="javascript:;" onclick="deleteData({{ $item->id }})" class="btn btn-danger btn-sm custom_danger_btn"><i class="fas fa-trash    "></i></a>
                                @endif



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
            $("#deleteForm").attr("action",'{{ url("admin/schedule/") }}'+"/"+id)
        }

        function scheduleStatus(id){
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
                url:"{{url('/admin/schedule-status/')}}"+"/"+id,
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
