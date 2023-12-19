@extends('layouts.lawyer.layout')
@section('title')
<title>{{ $website_lang->where('lang_key','upcoming_meeting')->first()->custom_lang }}</title>
@endsection
@section('lawyer-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><a href="{{ route('lawyer.create-zoom-meeting') }}" class="btn btn-primary"><i class="fas fa-plus" aria-hidden="true"></i> {{ $website_lang->where('lang_key','create')->first()->custom_lang }} </a></h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $website_lang->where('lang_key','upcoming_meeting')->first()->custom_lang }}</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th >{{ $website_lang->where('lang_key','serial')->first()->custom_lang }}</th>
                            <th >{{ $website_lang->where('lang_key','client')->first()->custom_lang }}</th>
                            <th >{{ $website_lang->where('lang_key','time')->first()->custom_lang }}</th>
                            <th >{{ $website_lang->where('lang_key','duration')->first()->custom_lang }}</th>
                            <th >{{ $website_lang->where('lang_key','meeting_id')->first()->custom_lang }}</th>
                            <th>{{ $website_lang->where('lang_key','action')->first()->custom_lang }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i=0;
                        @endphp
                        @foreach ($histories as $index => $meeting)
                            @php
                                $now=date('Y-m-d h:i:A');
                            @endphp

                            @if ($now <= date('Y-m-d h:i:A',strtotime($meeting->meeting_time)))
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $meeting->user->name }}</td>
                                    <td>
                                        {{ date('Y-m-d h:i:A',strtotime($meeting->meeting_time)) }}
                                    </td>
                                    <td>{{ $meeting->duration }} {{ $website_lang->where('lang_key','minute')->first()->custom_lang }}</td>
                                    <td>{{ $meeting->meeting_id }}</td>
                                    </td>
                                    <td>
                                        @if (env('PROJECT_MODE')==0)
                                            <a id="zoom_demo_mode" href="javascript:;"  class="btn btn-success btn-sm"><i class="fas fa-video"></i></a>
                                        @else
                                        <a target="_blank" href="{{ $meeting->meeting->join_url }}" class="btn btn-success btn-sm"><i class="fas fa-video"></i></a>
                                        @endif

                                </td>
                                </tr>
                            @endif

                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <script>
        (function($) {
        "use strict";
        $(document).ready(function () {
            $(document).on('click', '#zoom_demo_mode', function () {
                var demoNotify="{{ env('NOTIFY_TEXT') }}"
                toastr.error(demoNotify);
            });
        });
        })(jQuery);

        </script>
@endsection
