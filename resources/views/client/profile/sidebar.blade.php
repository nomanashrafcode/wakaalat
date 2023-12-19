@php
    $user_image=App\BannerImage::first();
@endphp
<div class="dashboard-widget">
    <div class="dashboard-account-info">
            @if ($user->image)
            <img src="{{ url($user->image) }}" alt="user image">
            @else
            <img src="{{ $user_image->default_profile ? url($user_image->default_profile) : '' }}" alt="user image">

            @endif

            <h3>{{ $user->name }}</h3>
            <p>{{ $website_lang->where('lang_key','client_id')->first()->custom_lang }}: {{ $user->client_id }}</p>
    </div>
     <ul>
         <li class="{{ request()->routeIs('client.dashboard')?'active':'' }}"><a href="{{ route('client.dashboard') }}"><i class="fas fa-chevron-right"></i> {{ $website_lang->where('lang_key','dashboard')->first()->custom_lang }}</a></li>
         <li class="{{ request()->routeIs('client.message')?'active':'' }}"><a href="{{ route('client.message') }}"><i class="fas fa-chevron-right"></i> {{ $website_lang->where('lang_key','message')->first()->custom_lang }}</a></li>

         <li class="{{ request()->routeIs('client.meeting-history')?'active':'' }}"><a href="{{ route('client.meeting-history') }}"><i class="fas fa-chevron-right"></i> {{ $website_lang->where('lang_key','meeting_history')->first()->custom_lang }}</a></li>

         <li class="{{ request()->routeIs('client.upcomming-meeting')?'active':'' }}"><a href="{{ route('client.upcomming-meeting') }}"><i class="fas fa-chevron-right"></i> {{ $website_lang->where('lang_key','upcoming_meeting')->first()->custom_lang }} </a></li>

         <li class="{{ request()->routeIs('client.account')?'active':'' }}"><a href="{{ route('client.account') }}"><i class="fas fa-chevron-right"></i> {{ $website_lang->where('lang_key','account_info')->first()->custom_lang }}</a></li>
         <li class="{{ request()->routeIs('client.appointment') || request()->routeIs('client.show-appointment')?'active':'' }}"><a href="{{ route('client.appointment') }}"><i class="fas fa-chevron-right"></i> {{ $website_lang->where('lang_key','appointment_list')->first()->custom_lang }}</a></li>
         <li class="{{ request()->routeIs('client.order') || request()->routeIs('client.show-order')?'active':'' }}"><a href="{{ route('client.order') }}"><i class="fas fa-chevron-right"></i> {{ $website_lang->where('lang_key','order_list')->first()->custom_lang }}</a></li>




         <li class="{{ request()->routeIs('client.change.password')?'active':'' }}"><a href="{{ route('client.change.password') }}"><i class="fas fa-chevron-right"></i> {{ $website_lang->where('lang_key','change_password')->first()->custom_lang }}</a></li>


         <li><a href="{{ route('logout') }}"><i class="fas fa-chevron-right"></i> {{ $website_lang->where('lang_key','logout')->first()->custom_lang }}</a></li>
     </ul>
 </div>
