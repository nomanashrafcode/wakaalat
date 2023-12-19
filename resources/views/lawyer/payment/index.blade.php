@extends('layouts.lawyer.layout')
@section('title')
<title>{{ $website_lang->where('lang_key','payment')->first()->custom_lang }}</title>
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

    <div id="payment-history">
    <div class="row">
         <!-- Earnings (Monthly) Card Example -->
         <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                {{ $website_lang->where('lang_key','earning')->first()->custom_lang }} ({{ $website_lang->where('lang_key','last_30')->first()->custom_lang }})</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $currency->currency_icon }}{{ $payment }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                {{ $website_lang->where('lang_key','total_client')->first()->custom_lang }} ({{ $website_lang->where('lang_key','last_30')->first()->custom_lang }})</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $appointment }}</div>
                        </div>

                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $website_lang->where('lang_key','payment_history')->first()->custom_lang }}</h6>
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
                            <th width="20%">{{ $website_lang->where('lang_key','amount')->first()->custom_lang }}</th>
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
                            <td>{{ $currency->currency_icon }}{{ $item->appointment_fee }}</td>

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
                    url: "{{ route('lawyer.search.payment.history') }}",
                    data:{from_date,to_date,lawyer_id},
                    success: function (response) {
                        $('#payment-history').html(response)
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
