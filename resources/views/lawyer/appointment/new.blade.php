@extends('layouts.lawyer.layout')
@section('title')
<title>{{ $website_lang->where('lang_key','new_appointment')->first()->custom_lang }}</title>
@endsection
@section('lawyer-content')

    <!-- DataTales Example -->
    <div class="row mb-2" id="searchSchedule">
        <div class="col-md-3">
            <div class="form-group">
                <label for="">{{ $website_lang->where('lang_key','from')->first()->custom_lang }}</label>
                <input type="text" class="form-control datepicker" id="from_date">
                <p class="invalid-feedback d-none" id="from_date_error"></p>
                <input type="hidden" name="lawyer_id" value="{{ $lawyer->id }}" id="lawyer_id">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="">{{ $website_lang->where('lang_key','to')->first()->custom_lang }}</label>
                <input type="text" id="to_date" class="form-control datepicker">
            </div>
        </div>
        <div class="col-md-3 newsearch">
            <button type="button" id="searchParticularSchedule" class="btn btn-success">{{ $website_lang->where('lang_key','search')->first()->custom_lang }}</button>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $website_lang->where('lang_key','new_appointment')->first()->custom_lang }}</h6>
        </div>
        <div class="card-body" id="search-particular-appointment">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="5%">{{ $website_lang->where('lang_key','serial')->first()->custom_lang }}</th>
                            <th width="15%">{{ $website_lang->where('lang_key','name')->first()->custom_lang }}</th>
                            <th width="15%">{{ $website_lang->where('lang_key','email')->first()->custom_lang }}</th>
                            <th width="15%">{{ $website_lang->where('lang_key','phone')->first()->custom_lang }}</th>
                            <th width="15%">{{ $website_lang->where('lang_key','date')->first()->custom_lang }}</th>
                            <th width="25%">{{ $website_lang->where('lang_key','time')->first()->custom_lang }}</th>
                            <th width="5%">{{ $website_lang->where('lang_key','payment')->first()->custom_lang }}</th>
                            <th width="10%">{{ $website_lang->where('lang_key','action')->first()->custom_lang }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($appointments as $index => $item)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{ $item->user->name }}</td>
                            <td>{{ $item->user->email }}</td>
                            <td>{{ $item->user->phone }}</td>
                            <td>{{ date('m-d-Y',strtotime($item->date)) }}</td>
                            <td>{{ strtoupper($item->schedule->start_time).'-'.strtoupper($item->schedule->end_time) }}</td>
                            <td>
                                @if ($item->payment_status==0)
                                        <span class="badge badge-danger">{{ $website_lang->where('lang_key','pending')->first()->custom_lang }}</span>
                                    @else
                                    <span class="badge badge-success">{{ $website_lang->where('lang_key','success')->first()->custom_lang }}</span>
                                    @endif
                            </td>
                            <td>
                                <a href="{{ route('lawyer.meet',$item->id) }}"  class="btn btn-primary btn-sm">{{ $website_lang->where('lang_key','meet')->first()->custom_lang }}</a>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>



    <script>
	(function($) {

    "use strict";
         // remove prescribe medicine input field row
         $(document).on('click', '#searchParticularSchedule', function () {
            var from_date=$("#from_date").val();
            var lawyer_id=$("#lawyer_id").val();
            if(from_date){
                $('#from_date').removeClass('is-invalid')
                $('#from_date_error').addClass('d-none')
                var to_date=$("#to_date").val();
                if(to_date) to_date=to_date;
                else to_date=from_date;
                $.ajax({
                    type: 'GET',
                    url: "{{ route('lawyer.search.particuler.appointment') }}",
                    data:{from_date,to_date,lawyer_id},
                    success: function (response) {
                        $('#search-particular-appointment').html(response)

                    },
                    error: function(err) {
                        console.log(err);
                    }
                });

            }else{
                toastr.error('{{ $from_date_error }}')
                $('#from_date').addClass('is-invalid')
                $('#from_date_error').text('{{ $from_date_error }}')
                $('#from_date_error').removeClass('d-none')
            }


        });
	})(jQuery);
    </script>

@endsection
