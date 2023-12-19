@extends('layouts.admin.layout')
@section('title')
<title>{{ $website_lang->where('lang_key','order')->first()->custom_lang }}</title>
@endsection
@section('admin-content')
 <!-- Appointment Details -->
 <h2>{{ $website_lang->where('lang_key','order_id')->first()->custom_lang }}: <b>{{ $order->order_id }}</b> </h2>
 <div class="row">
    <div class="col-md-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{ $website_lang->where('lang_key','client_info')->first()->custom_lang }}</h6>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <td>{{ $website_lang->where('lang_key','name')->first()->custom_lang }}</td>
                        <td>{{ ucwords($order->user->name) }}</td>
                    </tr>
                    <tr>
                        <td>{{ $website_lang->where('lang_key','email')->first()->custom_lang }}</td>
                        <td>{{ $order->user->email }}</td>
                    </tr>
                    <tr>
                        <td>{{ $website_lang->where('lang_key','phone')->first()->custom_lang }}</td>
                        <td>{{ $order->user->phone }}</td>
                    </tr>

                    <tr>
                        <td>{{ $website_lang->where('lang_key','age')->first()->custom_lang }}</td>
                        <td>{{ $order->user->age }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{ $website_lang->where('lang_key','billing_info')->first()->custom_lang }}</h6>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td>{{ $website_lang->where('lang_key','appointment_fee')->first()->custom_lang }}</td>
                            <td>{{ $currency->currency_icon }}{{ $order->total_payment }}</td>
                        </tr>
                        <tr>
                            <td>{{ $website_lang->where('lang_key','payment_method')->first()->custom_lang }}</td>
                            <td>{{ $order->payment_method }}</td>
                        </tr>
                        @if ($order->payment_transaction_id)
                        <tr>
                            <td>{{ $website_lang->where('lang_key','tran_id')->first()->custom_lang }}</td>
                            <td>{{ $order->payment_transaction_id }}</td>
                        </tr>
                        @endif
                        @if ($order->last4)
                            <tr>
                                <td>{{ $website_lang->where('lang_key','stripe_last_digit')->first()->custom_lang }}</td>
                                <td>{{ $order->last4 }}</td>
                            </tr>
                        @endif

                        @if ($order->payment_description)
                        <tr>
                            <td>{{ $website_lang->where('lang_key','description')->first()->custom_lang }}</td>
                            <td>{!! clean(nl2br(e($order->payment_description))) !!}</td>
                        </tr>
                        @endif

                        <tr>
                            <td>{{ $website_lang->where('lang_key','payment_status')->first()->custom_lang }}</td>
                            <td>
                                @if ($order->payment_status==1)
                                    <span class="badge badge-success">{{ $website_lang->where('lang_key','success')->first()->custom_lang }}</span>
                                @else
                                <span class="badge badge-danger">{{ $website_lang->where('lang_key','pending')->first()->custom_lang }}</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{ $website_lang->where('lang_key','app_info')->first()->custom_lang }}</h6>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>{{ $website_lang->where('lang_key','serial')->first()->custom_lang }}</th>
                            <th>{{ $website_lang->where('lang_key','lawyer')->first()->custom_lang }}</th>
                            <th>{{ $website_lang->where('lang_key','phone')->first()->custom_lang }}</th>
                            <th>{{ $website_lang->where('lang_key','schedule')->first()->custom_lang }}</th>
                            <th>{{ $website_lang->where('lang_key','date')->first()->custom_lang }}</th>
                            <th>{{ $website_lang->where('lang_key','appointment_fee')->first()->custom_lang }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->appointments as $index => $item)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{ $item->lawyer->name }}</td>
                            <td>{{ $item->lawyer->phone }}</td>
                            <td>{{ strtoupper($item->schedule->start_time).'-'.strtoupper($item->schedule->end_time) }}</td>
                            <td>{{ date('m-d-Y',strtotime($item->date)) }}</td>
                            <td>
                                {{ $currency->currency_icon }}{{ $item->appointment_fee }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    @if ($order->payment_status==0)
        <a href="{{ route('admin.payment.accept',$order->id) }}" class="btn btn-success ml-3">{{ $website_lang->where('lang_key','payment_accept')->first()->custom_lang }}</a>
    @endif
    <a href="{{ route('admin.cancle.order',$order->id) }}" class="btn btn-danger ml-3">{{ $website_lang->where('lang_key','delete_order')->first()->custom_lang }}</a>

</div>

@endsection

