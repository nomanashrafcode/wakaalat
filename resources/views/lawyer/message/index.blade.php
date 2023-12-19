@extends('layouts.lawyer.layout')
@section('title')
<title>{{ $website_lang->where('lang_key','message')->first()->custom_lang }}</title>
@endsection
@section('lawyer-content')
<style>
    /* width */
    ::-webkit-scrollbar {
        width: 7px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: #a7a7a7;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
        background: #929292;
    }

    ul {
        margin: 0;
        padding: 0;
    }

    li {
        list-style: none;
    }

    .user-wrapper, .message-wrapper {
        border: 1px solid #dddddd;
        overflow-y: auto;
    }

    .user-wrapper {
        height: 600px;
    }

    .user {
        cursor: pointer;
        padding: 5px 0;
        position: relative;
    }

    .user:hover {
        background: #eeeeee;
    }

    .user:last-child {
        margin-bottom: 0;
    }

    .pending {
        position: absolute;
        left: 13px;
        top: 9px;
        background: #b600ff;
        margin: 0;
        border-radius: 50%;
        width: 18px;
        height: 18px;
        line-height: 18px;
        padding-left: 5px;
        color: #ffffff;
        font-size: 12px;
    }

    .media-left {
        margin: 0 10px;
    }

    .media-left img {
        width: 64px;
        border-radius: 64px;
        height: 64px;
        object-fit: cover !important;
    }

    .media-body p {
        margin: 6px 0;
    }

    .message-wrapper {
        padding: 10px;
        height: 536px;
        background: #eeeeee;
    }

    .messages .message {
        margin-bottom: 15px;
    }

    .messages .message:last-child {
        margin-bottom: 0;
    }

    .received, .sent {
        max-width: 100%;
        padding: 3px 10px;
        border-radius: 10px;
    }

    .received {
        background: #ffffff;
    }

    .sent {
        background: #3bebff;
        float: right;
        text-align: right;
    }

    .message p {
        margin: 5px 0;
    }

    .date {
        color: #777777;
        font-size: 12px;
    }

    .active {
        background: #eeeeee;
    }

    input[type=text] {
        width: 100%;
        padding: 12px 20px;
        margin: 15px 0 0 0;
        display: inline-block;
        border-radius: 4px;
        box-sizing: border-box;
        outline: none;
        border: 1px solid #cccccc;
    }

    input[type=text]:focus {
        border: 1px solid #aaaaaa;
    }
    #sentMessageBtn{
        margin-top: 15px;
        padding: 10px;
    }
</style>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="user-wrapper">
                        <ul class="users">
                            @foreach ($users as $user)
                            <li class="user" id="{{ $user->user->id }}">
                                @php
                                    $lawyer=Auth::guard('lawyer')->user();
                                    $count=App\Message::where(['lawyer_id'=>$lawyer->id,'user_id'=>$user->user->id,'lawyer_view'=>0])->count();
                                @endphp

                                @if ($count>0)
                                <span class="pending">{{ $count }}</span>
                                @endif

                                <div class="media">
                                    <div class="media-left">
                                        <img src="{{ $user->user->image ? url($user->user->image) : url($profile_image) }}" alt="user image" class="media-object">
                                    </div>

                                    <div class="media-body">
                                        <p class="name">{{ $user->user->name }}</p>
                                        <p class="email">{{ $user->user->email }}</p>
                                    </div>
                                </div>
                            </li>
                            @endforeach

                        </ul>
                    </div>
                </div>
                <div class="col-md-8" id="messages">

                </div>
            </div>
        </div>
    </div>

    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>

        var receiver_id = '';
        var my_id = "{{ Auth::id() }}";

		(function($) {

    "use strict";


        $(document).ready(function () {
        // ajax setup form csrf token
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $('.user').on('click',function () {
            $('.user').removeClass('active');
            $(this).addClass('active');
            $(this).find('.pending').remove();

            receiver_id = $(this).attr('id');
            $.ajax({
                type: "get",
                url: "{{ url('lawyer/get-message/') }}" + "/" + receiver_id, // need to create this route
                data: "",
                cache: false,
                success: function (data) {
                    $('#messages').html(data);
                    scrollToBottomFunc();
                }
            });
        });

        $('.user').on('click',function () {
            $('.user').removeClass('active');
            $(this).addClass('active');
            $(this).find('.pending').remove();

            receiver_id = $(this).attr('id');
            $.ajax({
                type: "get",
                url: "{{ url('lawyer/get-message/') }}"+ "/" + receiver_id,
                data: "",
                cache: false,
                success: function (data) {
                    $('#messages').html(data);
                    scrollToBottomFunc();
                }
            });
        });






        // send message by key presss
        $(document).on('keyup', '.input-text input', function (e) {
            var message = $(this).val();

            if(message != ''){
                $("#sentMessageBtn").prop("disabled", false);
            }else{
                $("#sentMessageBtn").prop("disabled", true);
            }

            if (e.keyCode == 13 && message != '' && receiver_id != '') {
                $(this).val('');

                var datastr = "receiver_id=" + receiver_id + "&message=" + message;

                // project demo mode check
                var isDemo="{{ env('PROJECT_MODE') }}"
                var demoNotify="{{ env('NOTIFY_TEXT') }}"
                if(isDemo==0){
                    toastr.error(demoNotify);
                    return;
                }
                // end
                $.ajax({
                    type: "get",
                    url: "{{ url('/lawyer/send-message') }}",
                    data: datastr,
                    cache: false,
                    success: function (data) {
                        scrollToBottomFunc();
                        $('#' + data.user_id).click();
                    },
                    error: function (jqXHR, status, err) {
                    }
                })
            }
        });


        });

		})(jQuery);

         // make a function to scroll down auto
    function scrollToBottomFunc() {
        $('.message-wrapper').animate({
            scrollTop: $('.message-wrapper').get(0).scrollHeight
        }, 50);
    }

    function sendMessage(){
        var message=$(".submit").val();
        $(".submit").val('')
        var datastr = "receiver_id=" + receiver_id + "&message=" + message;

        // project demo mode check
        var isDemo="{{ env('PROJECT_MODE') }}"
         var demoNotify="{{ env('NOTIFY_TEXT') }}"
         if(isDemo==0){
             toastr.error(demoNotify);
             return;
         }
         // end
        $.ajax({
            type: "get",
            url: "{{ url('/lawyer/send-message') }}",
            data: datastr,
            cache: false,
            success: function (data) {
                scrollToBottomFunc();
                $('#' + data.user_id).click();

            },
            error: function (jqXHR, status, err) {
            }
        })


    }

    </script>
@endsection
