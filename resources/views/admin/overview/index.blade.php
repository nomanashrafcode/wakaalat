@extends('layouts.admin.layout')
@section('title')
<title>{{ $website_lang->where('lang_key','overview')->first()->custom_lang }}</title>
@endsection
@section('admin-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><a href="javascript:;" data-toggle="modal" data-target="#newCategory" class="btn btn-primary"><i class="fas fa-plus" aria-hidden="true"></i> {{ $website_lang->where('lang_key','create')->first()->custom_lang }}</a></h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $website_lang->where('lang_key','overview_table')->first()->custom_lang }}</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>{{ $website_lang->where('lang_key','serial')->first()->custom_lang }}</th>
                            <th>{{ $website_lang->where('lang_key','name')->first()->custom_lang }}</th>
                            <th>{{ $website_lang->where('lang_key','qty')->first()->custom_lang }}</th>
                            <th>{{ $website_lang->where('lang_key','icon')->first()->custom_lang }}</th>
                            <th>{{ $website_lang->where('lang_key','status')->first()->custom_lang }}</th>
                            <th>{{ $website_lang->where('lang_key','action')->first()->custom_lang }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($overviews as $index => $item)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->qty }}</td>
                            <td><i class="{{ $item->icon }}" aria-hidden="true"></i></td>
                            <td>
                                @if ($item->status==1)
                                <a href="" onclick="overviewStatus({{ $item->id }})"><input type="checkbox" checked data-toggle="toggle" data-on="{{ $website_lang->where('lang_key','active')->first()->custom_lang }}" data-off="{{ $website_lang->where('lang_key','inactive')->first()->custom_lang }}" data-onstyle="success" data-offstyle="danger"></a>
                                @else
                                    <a href="" onclick="overviewStatus({{ $item->id }})"><input type="checkbox" data-toggle="toggle" data-on="{{ $website_lang->where('lang_key','active')->first()->custom_lang }}" data-off="{{ $website_lang->where('lang_key','inactive')->first()->custom_lang }}" data-onstyle="success" data-offstyle="danger"></a>

                                @endif
                            </td>
                            <td>
                                <a href="javascript:;" data-toggle="modal" data-target="#updateCategory-{{ $item->id }}" class="btn btn-primary btn-sm"><i class="fas fa-edit    "></i></a>
                                <a data-toggle="modal" data-target="#deleteModal" href="javascript:;" onclick="deleteData({{ $item->id }})" class="btn btn-danger btn-sm"><i class="fas fa-trash    "></i></a>


                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Create Blog Category Modal -->
    <div class="modal fade" id="newCategory" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title">{{ $website_lang->where('lang_key','overview_form')->first()->custom_lang }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                <div class="modal-body">
                    <div class="container-fluid">

                        <form action="{{ route('admin.overview.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="name">{{ $website_lang->where('lang_key','name')->first()->custom_lang }}</label>
                                <input type="text" class="form-control" name="name" id="name">
                            </div>
                            <div class="form-group">
                                <label for="qty">{{ $website_lang->where('lang_key','qty')->first()->custom_lang }}</label>
                                <input type="number" class="form-control" name="qty" id="qty">
                            </div>
                            <div class="form-group">
                                <label for="icon">{{ $website_lang->where('lang_key','icon')->first()->custom_lang }}</label>
                                <input type="text" class="form-control custom-icon-picker" name="icon" id="icon">

                            </div>


                            <div class="form-group">
                                <label for="status">{{ $website_lang->where('lang_key','status')->first()->custom_lang }}</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="1">{{ $website_lang->where('lang_key','active')->first()->custom_lang }}</option>
                                    <option value="0">{{ $website_lang->where('lang_key','inactive')->first()->custom_lang }}</option>
                                </select>
                            </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">{{ $website_lang->where('lang_key','close')->first()->custom_lang }}</button>
                    <button type="submit" class="btn btn-primary">{{ $website_lang->where('lang_key','save')->first()->custom_lang }}</button>
                </div>
            </form>
            </div>
        </div>
    </div>

    <!-- update Blog Category Modal -->
    @foreach ($overviews as $item)
        <div class="modal fade" id="updateCategory-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                        <div class="modal-header">
                                <h5 class="modal-title">{{ $website_lang->where('lang_key','overview_form')->first()->custom_lang }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                            </div>
                    <div class="modal-body">
                        <div class="container-fluid">

                            <form action="{{ route('admin.overview.update',$item->id) }}" method="post">
                                @csrf
                                @method('patch')
                                <div class="form-group">
                                    <label for="name">{{ $website_lang->where('lang_key','name')->first()->custom_lang }}</label>
                                    <input type="text" class="form-control" name="name" id="name" value="{{ $item->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="qty">{{ $website_lang->where('lang_key','qty')->first()->custom_lang }}</label>
                                    <input type="number" class="form-control" name="qty" id="qty" value="{{ $item->qty }}">
                                </div>
                                <div class="form-group">
                                    <label for="icon">{{ $website_lang->where('lang_key','icon')->first()->custom_lang }}</label>
                                    <input type="text" class="form-control custom-icon-picker" name="icon" id="icon" value="{{ $item->icon }}">

                                </div>

                                <div class="form-group">
                                    <label for="status">{{ $website_lang->where('lang_key','status')->first()->custom_lang }}</label>
                                    <select name="status" id="status" class="form-control">
                                        <option {{ $item->status==1 ? 'selected' :'' }} value="1">{{ $website_lang->where('lang_key','active')->first()->custom_lang }}</option>
                                        <option {{ $item->status==0 ? 'selected' :'' }} value="0">{{ $website_lang->where('lang_key','inactive')->first()->custom_lang }}</option>
                                    </select>
                                </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">{{ $website_lang->where('lang_key','close')->first()->custom_lang }}</button>
                        <button type="submit" class="btn btn-primary">{{ $website_lang->where('lang_key','update')->first()->custom_lang }}</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    @endforeach



    <script>
        function deleteData(id){
            $("#deleteForm").attr("action",'{{ url("admin/overview/") }}'+"/"+id)
        }

        function overviewStatus(id){
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
                url:"{{url('/admin/overview-status/')}}"+"/"+id,
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
