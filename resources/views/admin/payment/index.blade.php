@extends('layouts.admin.layout')
@section('title')
<title>{{ $website_lang->where('lang_key','payment')->first()->custom_lang }}</title>
@endsection
@section('admin-content')
    <!-- DataTales Example -->
    <div class="row mb-2" id="searchSchedule">
        <div class="col-md-3">
            <div class="form-group">
                <label for="">{{ $website_lang->where('lang_key','from')->first()->custom_lang }} <span class="text-danger">*</span></label>
                <input type="text" class="form-control datepicker" id="from_date">
                <p class="invalid-feedback d-none" id="from_date_error"></p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="">{{ $website_lang->where('lang_key','to')->first()->custom_lang }}</label>
                <input type="text" id="to_date" class="form-control datepicker">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="">{{ $website_lang->where('lang_key','lawyer')->first()->custom_lang }}</label>
                <select name="lawyer_id" id="lawyer_id" class="form-control select2">
                    <option value="">{{ $website_lang->where('lang_key','select_lawyer')->first()->custom_lang }}</option>
                    @foreach ($lawyers as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-1 newsearch">
            <button type="button" id="searchPrescribe" class="btn btn-success">{{ $website_lang->where('lang_key','search')->first()->custom_lang }}</button>
        </div>
    </div>
    <div id="payment-box">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $website_lang->where('lang_key','payment_history')->first()->custom_lang }}
                <button class="btn btn-success btn-sm" onclick="printReport()"><i class="fas fa-print    "></i></button>
            </h6>
        </div>
        <div class="card-body" id="search-appointment">
            <div class="table-responsive printArea">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="5%">{{ $website_lang->where('lang_key','serial')->first()->custom_lang }}</th>
                            <th width="15%">{{ $website_lang->where('lang_key','name')->first()->custom_lang }}</th>
                            <th width="15%">{{ $website_lang->where('lang_key','email')->first()->custom_lang }}</th>
                            <th width="15%">{{ $website_lang->where('lang_key','phone')->first()->custom_lang }}</th>
                            <th width="5%">{{ $website_lang->where('lang_key','payment')->first()->custom_lang }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lawyers as $index => $lawyer)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{ ucfirst($lawyer->name) }}</td>
                            <td>{{ $lawyer->email }}</td>
                            <td>{{ $lawyer->phone }}</td>
                            @php
                                $total=$lawyerPayments->where('lawyer_id',$lawyer->id)->sum('appointment_fee')
                            @endphp
                            <td>
                                {{ $currency->currency_icon }}{{ $total }}
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

    <script>
	(function($) {

    "use strict";
        // remove prescribe medicine input field row
        $(document).on('click', '#searchPrescribe', function () {
           var from_date=$("#from_date").val();
           var doctor_id=$("#doctor_id").val();
           if(from_date){
               $('#from_date').removeClass('is-invalid')
               $('#from_date_error').addClass('d-none')
               var to_date=$("#to_date").val();
               if(to_date) to_date=to_date;
               else to_date=from_date;
               $.ajax({
                   type: 'GET',
                   url: "{{ route('admin.payment.search') }}",
                   data:{from_date,to_date,doctor_id},
                   success: function (response) {
                       $('#payment-box').html(response)

                   },
                   error: function(err) {
                       console.log(err);
                   }
               });

           }else{
               toastr.error('From Date Is Required')
               $('#from_date').addClass('is-invalid')
               $('#from_date_error').text('From Date Is Required')
               $('#from_date_error').removeClass('d-none')
           }


       });
	   })(jQuery);

   </script>
@endsection

