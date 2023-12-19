@extends('layouts.lawyer.layout')
@section('title')
<title>{{ $website_lang->where('lang_key','today_appointment')->first()->custom_lang }}</title>
@endsection
@section('lawyer-content')
    <!-- DataTales Example -->
    <div class="mb-4">
        <div class="row" id="searchSchedule">
            <div class="col-md-3">
                <select name="schedule_id" class="form-control select2" id="schedule_id">
                    <option value="">{{ $website_lang->where('lang_key','select_schedule')->first()->custom_lang }}</option>
                    @foreach ($schedules as $schedule)
                        <option value="{{ $schedule->id }}">{{ $schedule->start_time.'-'.$schedule->end_time }}</option>
                    @endforeach
                </select>
                <p class="invalid-feedback d-none" id="schedule_error"></p>
                <input type="hidden" name="lawyer_id" value="{{ $lawyer->id }}" id="lawyer_id">
            </div>
            <div class="col-md-3">
               <button type="button" id="searchDoctorSchedule" class="btn btn-success">{{ $website_lang->where('lang_key','search')->first()->custom_lang }}</button>
            </div>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $website_lang->where('lang_key','today_appointment')->first()->custom_lang }}</h6>
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
         $(document).on('click', '#searchDoctorSchedule', function () {
            var schedule_id=$("#schedule_id").val();
            var lawyer_id=$("#lawyer_id").val();
            if(schedule_id){
                $('#schedule_id').removeClass('is-invalid')
                $('#schedule_error').addClass('d-none')
                $.ajax({
                    type: 'GET',
                    url: "{{ route('lawyer.search.appointment') }}",
                    data:{'schedule_id':schedule_id,'lawyer_id':lawyer_id},
                    success: function (response) {
                        $('#search-appointment').html(response)
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });

            }else{
                toastr.error('{{ $schedule_error }}')
                $('#schedule_id').addClass('is-invalid')
                $('#schedule_error').text('{{ $schedule_error }}')
                $('#schedule_error').removeClass('d-none')
            }


        });

})(jQuery);
    </script>

@endsection
