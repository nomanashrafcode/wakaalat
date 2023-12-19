@extends('layouts.admin.layout')
@section('title')
<title>{{ $website_lang->where('lang_key','service_faq')->first()->custom_lang }}</title>
@endsection
@section('admin-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800 d-inline"><a href="{{ route('admin.service.index') }}" class="btn btn-primary"><i class="fas fa-list" aria-hidden="true"></i> {{ $website_lang->where('lang_key','all_service')->first()->custom_lang }} </a></h1>
    <h1 class="h3 mb-2 text-gray-800 d-inline"><a href="#" data-toggle="modal" data-target="#addFaq" class="btn btn-success"><i class="fas fa-plus" aria-hidden="true"></i> {{ $website_lang->where('lang_key','new_faq')->first()->custom_lang }} </a></h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4 mt-3">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $website_lang->where('lang_key','service_faq')->first()->custom_lang }}</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="5%">{{ $website_lang->where('lang_key','serial')->first()->custom_lang }}</th>
                            <th width="10%">{{ $website_lang->where('lang_key','service')->first()->custom_lang }}</th>
                            <th width="20%">{{ $website_lang->where('lang_key','qus')->first()->custom_lang }}</th>
                            <th width="45%">{{ $website_lang->where('lang_key','ans')->first()->custom_lang }}</th>
                            <th width="10%">{{ $website_lang->where('lang_key','status')->first()->custom_lang }}</th>
                            <th width="10%">{{ $website_lang->where('lang_key','action')->first()->custom_lang }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($faqs as $index => $item)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{ $item->service->header }}</td>
                            <td>{{ $item->question}}</td>
                            <td>{!! clean($item->answer) !!}</td>
                            <td>
                                @if ($item->status==1)
                                <a href="" onclick="serviceFaqStatus({{ $item->id }})"><input type="checkbox" checked data-toggle="toggle" data-on="{{ $website_lang->where('lang_key','active')->first()->custom_lang }}" data-off="{{ $website_lang->where('lang_key','inactive')->first()->custom_lang }}" data-onstyle="success" data-offstyle="danger"></a>
                                @else
                                    <a href="" onclick="serviceFaqStatus({{ $item->id }})"><input type="checkbox" data-toggle="toggle" data-on="{{ $website_lang->where('lang_key','active')->first()->custom_lang }}" data-off="{{ $website_lang->where('lang_key','inactive')->first()->custom_lang }}" data-onstyle="success" data-offstyle="danger"></a>

                                @endif
                            </td>
                            <td>
                                <a href="#" data-toggle="modal" data-target="#updateFaq-{{ $item->id }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                <a data-toggle="modal" data-target="#deleteModal" href="javascript:;" onclick="deleteData({{ $item->id }})" class="btn btn-danger btn-sm"><i class="fas fa-trash    "></i></a>


                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- create new Faq Modal -->
    <div class="modal fade" id="addFaq" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title">{{ $website_lang->where('lang_key','service_faq')->first()->custom_lang }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                <div class="modal-body">
                    <div class="container-fluid">

                    <form action="{{ route('admin.faq-service.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="question">{{ $website_lang->where('lang_key','qus')->first()->custom_lang }}</label>
                            <input type="text" class="form-control" name="question" id="question" value="{{ old('question') }}" >
                            <input type="hidden" name="service_id" value="{{ $id }}">
                        </div>
                        <div class="form-group">
                            <label for="answer">{{ $website_lang->where('lang_key','ans')->first()->custom_lang }}</label>
                            <textarea class="summernote" id="answer" name="answer">{{ old('answer') }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="status">{{ $website_lang->where('lang_key','status')->first()->custom_lang }}</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="1">{{ $website_lang->where('lang_key','active')->first()->custom_lang }}</option>
                                        <option value="0">{{ $website_lang->where('lang_key','inactive')->first()->custom_lang }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ $website_lang->where('lang_key','close')->first()->custom_lang }}</button>
                        <button type="submit" class="btn btn-success">{{ $website_lang->where('lang_key','save')->first()->custom_lang }}</button>
                    </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

     <!-- update new Faq Modal -->
     @foreach ($faqs as $item)
    <div class="modal fade" id="updateFaq-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title">{{ $website_lang->where('lang_key','service_faq')->first()->custom_lang }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                <div class="modal-body">
                    <div class="container-fluid">

                    <form action="{{ route('admin.faq-service.update',$item->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="form-group">
                            <label for="question">{{ $website_lang->where('lang_key','qus')->first()->custom_lang }}</label>
                            <input type="text" class="form-control" name="question" id="question" value="{{ $item->question }}">
                            <input type="hidden" name="service_id" value="{{ $id }}">
                        </div>
                        <div class="form-group">
                            <label for="answer">{{ $website_lang->where('lang_key','ans')->first()->custom_lang }}</label>
                            <textarea class="summernote" id="answer" name="answer">{{ $item->answer }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="status">{{ $website_lang->where('lang_key','status')->first()->custom_lang }}</label>
                                    <select name="status" id="status" class="form-control">
                                        <option {{ $item->status==1 ? 'selected':'' }} value="1">{{ $website_lang->where('lang_key','active')->first()->custom_lang }}</option>
                                        <option {{ $item->status==0 ? 'selected':'' }} value="0">{{ $website_lang->where('lang_key','inactive')->first()->custom_lang }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ $website_lang->where('lang_key','close')->first()->custom_lang }}</button>
                        <button type="submit" class="btn btn-success">{{ $website_lang->where('lang_key','save')->first()->custom_lang }}</button>
                    </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @endforeach



    <script>
        function deleteData(id){
            $("#deleteForm").attr("action",'{{ url("/admin/faq-service/") }}'+"/"+id)
        }

        function serviceFaqStatus(id){
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
                url:"{{url('/admin/service-faq-status/')}}"+"/"+id,
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
