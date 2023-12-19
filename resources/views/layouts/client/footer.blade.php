@php
    $subscriberContent=App\Setting::first();
    $subscribeImage=App\BannerImage::first();
    $website_lang=App\ManageText::all();
@endphp

<!--Start of Tawk.to Script-->
@if ($subscriberContent->live_chat==1)
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='{{ $subscriberContent->livechat_script }}';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
    })();
</script>
@endif
<!--End of Tawk.to Script-->

<!--Subscribe Start-->
<div class="subscribe-area" style="background-image: url({{ $subscribeImage->subscribe_us ?  url($subscribeImage->subscribe_us) : '' }})">
    <div class="container">
        <div class="row ov_hd">
            <div class="col-md-12 wow fadeInDown" data-wow-delay="0.1s">
                <div class="main-headline white">
                    <h1>{{ ucwords($subscriberContent->subscribe_heading) }}</h1>
                    <p>{{ $subscriberContent->subscribe_description }}</p>
                </div>
            </div>
        </div>
        <div class="row ov_hd">
            <div class="col-md-12 wow fadeInUp" data-wow-delay="0.1s">
                <div class="subscribe-form">
                    <form method="POST" action="{{ url('subscribe-us') }}">
                        @csrf
                        <input type="email" required name="email" placeholder="{{ $website_lang->where('lang_key','email_address')->first()->custom_lang }}">
                        <button type="submit" class="btn-sub">{{ $website_lang->where('lang_key','subscribe_us')->first()->custom_lang }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Subscribe Start-->

<!--Brand-Area Start-->
<div class="brand-area bg-area">
    <div class="container">
        @php
            $partners=App\Partner::where('status',1)->get();
        @endphp
        <div class="row">
            <div class="col-12">
                <div class="brand-carousel owl-carousel">
                    @foreach ($partners as $item)
                    <a href="{{ $item->link }}">
                        <div class="brand-item">
                            <div class="brand-colume">
                                <div class="brand-bg"></div>
                                <img src="{{ url($item->image) }}" alt="Partner">
                            </div>
                        </div>
                    </a>
                    @endforeach


                </div>
            </div>
        </div>
    </div>
</div>
<!--Brand-Area End-->
@php
        $contact=App\ContactUs::first();
        $contactInformation=App\ContactInformation::first();
        $logo=App\Setting::first();
        $navbar=App\ManageNavigation::first();
        $navigation=App\Navigation::first();
        $setting=App\Setting::first();
        $isRtl=$setting->text_direction;
@endphp
<!--Footer Start-->
<div class="main-footer">
    <div class="top-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-sm-12">
                    <div class="footer-address">
                        <ul>
                            <li>
                                <i class="far fa-envelope"></i>
                                <h5>{{ $website_lang->where('lang_key','email_address')->first()->custom_lang }} </h5>
                                <p>{!! nl2br(e($contactInformation->emails)) !!}</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-12">
                    <div class="footer-address">
                        <ul>
                            <li>
                                <i class="fas fa-phone"></i>
                                <h5>{{ $website_lang->where('lang_key','phone')->first()->custom_lang }}</h5>
                                <p>{!! nl2br(e($contactInformation->phones)) !!}</p>

                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-12">
                    <div class="footer-address">
                        <ul>
                            <li>
                                <i class="fas fa-map-marker-alt"></i>
                                <h5>{{ $website_lang->where('lang_key','address')->first()->custom_lang }}</h5>
                                <p>{!! nl2br(e($contactInformation->address)) !!}</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-area" style="background-image: url({{ url('client/img/shape-2.png') }})">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="footer-item">
                        <h3>{{ $website_lang->where('lang_key','about_us')->first()->custom_lang }}</h3>
                        <div class="textwidget">
                            <p>
                                {{ $contactInformation->about }}
                            </p>


                            @if ($isRtl=='RTL')
                            <a class="sm_fbtn" href="{{ url('about-us') }}">{{ $website_lang->where('lang_key','learn_more')->first()->custom_lang }} ←</a>
                            @else
                            <a class="sm_fbtn" href="{{ url('about-us') }}">{{ $website_lang->where('lang_key','learn_more')->first()->custom_lang }} →</a>
                            @endif

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="footer-item">
                        <h3>{{ $website_lang->where('lang_key','important_link')->first()->custom_lang }}</h3>
                        <ul>
                            @if ($navbar->show_homepage==1)
                                <li><a href="{{ url('/') }}">{{ $navigation->home }}</a></li>
                            @endif
                            @if ($navbar->show_aboutus==1)
                                <li><a href="{{ url('about-us') }}">{{ $navigation->about_us }}</a></li>
                            @endif
                            @if ($navbar->show_department)
                                <li><a href="{{ url('department') }}">{{ $navigation->department }}</a></li>
                            @endif
                            @if ($navbar->show_doctor)
                                <li><a href="{{ url('doctor') }}">{{ $navigation->doctor }}</a></li>
                            @endif



                            <li><a href="{{ url('terms-condition') }}">{{ $navigation->terms_and_condition }}</a></li>
                            <li><a href="{{ url('privacy-policy') }}">{{ $navigation->privacy_policy }}</a></li>
                            @if ($navbar->show_blog==1)
                            <li><a href="{{ url('blog') }}">{{ $navigation->blog }}</a></li>
                            @endif
                            @if ($navbar->show_contactus==1)
                            <li><a href="{{ url('contact-us') }}">{{ $navigation->contact_us }}</a></li>
                            @endif


                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12">
                    @php
                        $latestBlogs=App\Blog::orderBy('id','desc')->take(3)->get();
                    @endphp
                    <div class="footer-item">
                        <h3>{{ $website_lang->where('lang_key','recent_posts')->first()->custom_lang }}</h3>
                        @foreach ($latestBlogs as $item)
                        <div class="footer-recent-item">
                            <div class="footer-recent-photo">
                                <a href="{{ url('blog-details/'.$item->slug) }}"><img src="{{ url($item->thumbnail_image) }}" alt="blog image"></a>
                            </div>
                            <div class="footer-recent-text">
                                <a href="{{ url('blog-details/'.$item->slug) }}">{{ $item->title }}</a>
                                <div class="footer-post-date">{{ $item->created_at->format('m-d-Y') }}</div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-copyrignt">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="copyright-text">
                        <p>{{ $contactInformation->copyright }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="footer-social">
                        @if ($contact->facebook)
                        <a href="{{ $contact->facebook }}"><i class="fab fa-facebook-f"></i></a>
                        @endif
                        @if ($contact->twitter)
                        <a href="{{ $contact->twitter }}"><i class="fab fa-twitter"></i></a>
                        @endif
                        @if ($contact->pinterest)
                        <a href="{{ $contact->pinterest }}"><i class="fab fa-pinterest-p"></i></a>
                        @endif
                        @if ($contact->linkedin)
                        <a href="{{ $contact->linkedin }}"><i class="fab fa-linkedin-in"></i></a>
                        @endif
                        @if ($contact->youtube)
                        <a href="{{ $contact->youtube }}"><i class="fab fa-youtube"></i></a>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Footer End-->

@php
    $cookie=App\Setting::first();
    $setting=App\Setting::first();
@endphp
@if ($cookie->allow_cookie_consent==1)
<div class="cookie-container">
    <p>
      {!! clean($cookie->cookie_text) !!}
    </p>

    <button class="cookie-btn">
      {{ ucwords($cookie->cookie_button_text) }}
    </button>
  </div>

@endif


<!--Scroll-Top-->
<div class="scroll-top">
    <i class="fas fa-angle-double-up"></i>
</div>
<!--Scroll-Top-->

<script>
    var isRtl="{{ $isRtl }}"
    var rtlTrue=false;
    if(isRtl=='RTL'){
        rtlTrue=true;
    }
</script>

<!--Js-->
<script src="{{ url('client/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ url('client/js/bootstrap.min.js') }}"></script>
<script src="{{ url('client/js/popper.min.js') }}"></script>
<script src="{{ url('client/js/jquery-ui.min.js') }}"></script>
<script src="{{ url('client/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ url('client/js/jquery.collapse.js') }}"></script>
<script src="{{ url('client/js/owl.carousel.min.js') }}"></script>
<script src="{{ url('client/js/swiper-bundle.js') }}"></script>
<script src="{{ url('client/js/jquery.filterizr.min.js') }}"></script>
<script src="{{ url('client/js/select2.min.js') }}"></script>
<script src="{{ url('client/js/wow.min.js') }}"></script>
<script src="{{ url('client/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('client/js/viewportchecker.js') }}"></script>
<script src="{{ url('client/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ url('client/js/cookie-consent.js') }}"></script>
<script src="{{ asset('client/js/jquery-ui.js') }}"></script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

<script src="{{ url('client/js/custom.js') }}"></script>

<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script src="{{ asset('toastr/toastr.min.js') }}"></script>
<script>
    @if(Session::has('messege'))
      var type="{{Session::get('alert-type','info')}}"
      switch(type){
          case 'info':
               toastr.info("{{ Session::get('messege') }}");
               break;
          case 'success':
              toastr.success("{{ Session::get('messege') }}");
              break;
          case 'warning':
             toastr.warning("{{ Session::get('messege') }}");
              break;
          case 'error':
              toastr.error("{{ Session::get('messege') }}");
              break;
      }
    @endif
</script>

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <script>
            toastr.error('{{ $error }}');
        </script>
    @endforeach
@endif


<script>
    //Search
    function openSearch() {
        document.getElementById("myOverlay").style.display = "block";
    }

    function closeSearch() {
        document.getElementById("myOverlay").style.display = "none";
    }

    //Mobile Menu
    function openNav() {
        document.getElementById("mySidenav").style.width = "100%";
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }

	(function($) {

    "use strict";
    // load available appointment in doctor details
    $(document).on('change', '#datepicker-value', function() {
            var value=$(this).val();
            var lawyer_id=$("#lawyer_id").val();
            var url="{{ url('/get-appointment/') }}";
            $.ajax({
            type: 'GET',
            url: url,
            data:{'lawyer_id':lawyer_id,'date':value},
            success: function (response) {
                if(response.success){
                    $("#doctor-available-schedule").html(response.success)
                    $("#schedule-box-outer").removeClass('d-none')
                    $("#doctor-schedule-error").addClass('d-none')
                    $("#sub").prop("disabled", false);
                }
                if(response.error){
                    $("#schedule-box-outer").addClass('d-none')
                    $("#doctor-schedule-error").removeClass('d-none')
                    $("#doctor-schedule-error").html(response.error)
                    $("#sub").prop("disabled", true);
                }

            },
            error: function(err) {
                console.log(err);
            }
        });
    });
	})(jQuery);


    // load doctor in modal
    function loadDoctor(){
        var id=$(".department-id").val();
        if(id){
            var url="{{ url('get-department-doctor/') }}"+"/"+id;
            $.ajax({
                type: 'GET',
                url: url,
                success: function (response) {
                    $(".lawyer-id").html(response)
                    $("#modal-doctor-box").removeClass('d-none')
                },
                error: function(err) {
                    console.log(err);
                }
            });

        }
    }
    // load doctor in mobile menu modal
    function loadMobileModalDoctor(){
        var id=$(".modal-department-id").val();
        if(id){
            var url="{{ url('get-department-doctor/') }}"+"/"+id;
            $.ajax({
                type: 'GET',
                url: url,
                success: function (response) {
                    $(".modal-lawyer-id").html(response)
                    $("#mobile-modal-doctor-box").removeClass('d-none')
                },
                error: function(err) {
                    console.log(err);
                }
            });

        }
    }

    // load date in modal
    function loadDate(){
        var lawyerId=$('.lawyer-id').val()
        $('#modal_lawyer_id').val(lawyerId)
        $("#modal-date-box").removeClass('d-none')

    }

    // load date in mobile menu modal
    function loadModalDate(){
        var lawyerId=$('.modal-lawyer-id').val()
        $('#mobile_modal_lawyer_id').val(lawyerId)
        $("#mobile-modal-date-box").removeClass('d-none')

    }




	(function($) {

    "use strict";
    // load available appointment in appoinment model
    $(document).on('change', '#modal-datepicker-value', function() {
            var value=$(this).val();
            var lawyer_id=$("#modal_lawyer_id").val();
            var url="{{ url('/get-appointment/') }}";
            $.ajax({
            type: 'GET',
            url: url,
            data:{'lawyer_id':lawyer_id,'date':value},
            success: function (response) {
                if(response.success){
                    $("#available-modal-schedule").html(response.success)
                    $("#modal-schedule-box").removeClass('d-none')
                    $("#modal-schedule-error").addClass('d-none')
                    $("#modal-sub").prop("disabled", false);
                }
                if(response.error){
                    $("#modal-schedule-box").addClass('d-none')
                    $("#modal-schedule-error").removeClass('d-none')
                    $("#modal-schedule-error").html(response.error)
                    $("#modal-sub").prop("disabled", true);


                }
            },
            error: function(err) {
                console.log(err);
            }
        });
    });

    // load available appointment in appoinment model
    $(document).on('change', '#mobile-modal-datepicker-value', function() {
            var value=$(this).val();
            var lawyer_id=$("#mobile_modal_lawyer_id").val();
            var url="{{ url('/get-appointment/') }}";
            $.ajax({
            type: 'GET',
            url: url,
            data:{'lawyer_id':lawyer_id,'date':value},
            success: function (response) {
                if(response.success){
                    $("#available-mobile-modal-schedule").html(response.success)
                    $("#mobile-modal-schedule-box").removeClass('d-none')
                    $("#mobile-modal-schedule-error").addClass('d-none')
                    $("#mobile-modal-sub").prop("disabled", false);
                }
                if(response.error){
                    $("#mobile-modal-schedule-box").addClass('d-none')
                    $("#mobile-modal-schedule-error").removeClass('d-none')
                    $("#mobile-modal-schedule-error").html(response.error)
                    $("#mobile-modal-sub").prop("disabled", true);
                }
            },
            error: function(err) {
                console.log(err);
            }
        });
    });
	})(jQuery);


// stripe

$(function() {
    var $form         = $(".require-validation");
  $('form.require-validation').bind('submit', function(e) {
    var $form         = $(".require-validation"),
        inputSelector = ['input[type=email]', 'input[type=password]',
                         'input[type=text]', 'input[type=file]',
                         'textarea'].join(', '),
        $inputs       = $form.find('.required').find(inputSelector),
        $errorMessage = $form.find('div.error'),
        valid         = true;
        $errorMessage.addClass('d-none');

        $('.has-error').removeClass('has-error');
    $inputs.each(function(i, el) {
      var $input = $(el);
      if ($input.val() === '') {
        $input.parent().addClass('has-error');
        $errorMessage.removeClass('d-none');
        e.preventDefault();
      }
    });

    if (!$form.data('cc-on-file')) {
      e.preventDefault();
      Stripe.setPublishableKey($form.data('stripe-publishable-key'));
      Stripe.createToken({
        number: $('.card-number').val(),
        cvc: $('.card-cvc').val(),
        exp_month: $('.card-expiry-month').val(),
        exp_year: $('.card-expiry-year').val()
      }, stripeResponseHandler);
    }

  });

  function stripeResponseHandler(status, response) {
        if (response.error) {
            $('.error')
                .removeClass('hide')
                .find('.alert')
                .text(response.error.message);
        } else {
            // token contains id, last4, and card type
            var token = response['id'];
            // insert the token into the form so it gets submitted to the server
            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form.get(0).submit();
        }
    }

});




</script>

<script>

    var receiver_id = '';
    @auth
    var my_id = "{{ Auth::guard('web')->user()->id }}";
    @endauth


	(function($) {

    "use strict";

    $(document).ready(function () {
        $('.user').on('click',function () {
            $('.user').removeClass('active');
            $(this).addClass('active');
            $(this).find('.pending').remove();

            receiver_id = $(this).attr('id');
            $.ajax({
                type: "get",
                url: "{{ url('client/get-message/') }}"+ "/" + receiver_id,
                data: "",
                cache: false,
                success: function (data) {
                    $('#messages').html(data);
                    scrollToBottomFunc();
                }
            });
        });

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
                    url: "{{ url('/client/send-message') }}",
                    data: datastr,
                    cache: false,
                    success: function (data) {
                        scrollToBottomFunc();
                        $('#' + data.lawyer_id).click();

                    },
                    error: function (jqXHR, status, err) {
                    }
                })
            }
        });


        $(document).on('click', '#zoom_demo_mode', function () {
        var demoNotify="{{ env('NOTIFY_TEXT') }}"
        toastr.error(demoNotify);
    });

    });
	})(jQuery);


    // make a function to scroll down auto
    function scrollToBottomFunc() {
        $('.message-wrapper').animate({
            scrollTop: $('.message-wrapper').get(0).scrollHeight
        }, 50);
    }

    // send messag by click button
    function sendMessage(){
        var message=$(".submit").val();
        $(".submit").val('');
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
            url: "{{ url('/client/send-message') }}",
            data: datastr,
            cache: false,
            success: function (data) {
                scrollToBottomFunc();
                $('#' + data.lawyer_id).click();
            },
            error: function (jqXHR, status, err) {
            }
        })


    }

</script>

</body>

</html>
