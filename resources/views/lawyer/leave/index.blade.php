@extends('layouts.lawyer.layout')
@section('title')
<title>{{ $website_lang->where('lang_key','leave_history')->first()->custom_lang }}</title>
@endsection
@section('lawyer-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><a href="javascript:;" data-toggle="modal" data-target="#newLeave" class="btn btn-primary"><i class="fas fa-plus" aria-hidden="true"></i> {{ $website_lang->where('lang_key','create')->first()->custom_lang }} </a></h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $website_lang->where('lang_key','leave_history')->first()->custom_lang }}</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>{{ $website_lang->where('lang_key','serial')->first()->custom_lang }}</th>
                            <th>{{ $website_lang->where('lang_key','date')->first()->custom_lang }}</th>
                            <th>{{ $website_lang->where('lang_key','action')->first()->custom_lang }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($leaves as $index => $item)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{  date('m-d-Y',strtotime($item->date)) }}</td>
                            <td>
                                <a href="javascript:;" data-toggle="modal" data-target="#updateLeave-{{ $item->id }}" class="btn btn-primary btn-sm"><i class="fas fa-edit    "></i></a>
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
    <div class="modal fade" id="newLeave" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title">{{ $website_lang->where('lang_key','leave_form')->first()->custom_lang }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form action="{{ route('lawyer.leave.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="date">{{ $website_lang->where('lang_key','date')->first()->custom_lang }}</label>
                                <input type="text" class="form-control datepicker" name="date" id="date">

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
    @foreach ($leaves as $item)
        <div class="modal fade" id="updateLeave-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                        <div class="modal-header">
                                <h5 class="modal-title">{{ $website_lang->where('lang_key','leave_form')->first()->custom_lang }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                            </div>
                    <div class="modal-body">
                        <div class="container-fluid">

                            <form action="{{ route('lawyer.leave.update',$item->id) }}" method="post">
                                @csrf
                                @method('patch')
                                <div class="form-group">
                                    <label for="date">{{ $website_lang->where('lang_key','date')->first()->custom_lang }}</label>
                                    <input type="date" class="form-control" name="date" id="date" value="{{ $item->date }}">

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
            $("#deleteForm").attr("action",'{{ url("lawyer/leave/") }}'+"/"+id)
        }
    </script>
@endsection
