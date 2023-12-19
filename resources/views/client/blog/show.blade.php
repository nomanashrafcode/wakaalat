@extends('layouts.client.layout')
@section('title')
<title>{{ @$blog->seo_title }}</title>
@endsection
@section('meta')
<meta name="description" content="{{ @$blog->seo_description }}">
@endsection
@section('client-content')


<!--Banner Start-->
<div class="banner-area flex" style="background-image:url({{ $banner->blog ? url($banner->blog) : '' }});">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="banner-text">
                    <h1>{{ $blog->title }}</h1>
                    <ul>
                        <li><a href="{{ url('/') }}">{{ $navigation->home }}</a></li>
                        <li><a href="{{ url('/blog') }}">{{ $navigation->blog }}</a></li>
                        <li><span>{{ $blog->title }}</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Banner End-->

<!--Blog Start-->
<div class="blog-page single-blog pt_40 pb_90">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="blog-item">
                    <div class="single-blog-image">
                        <img src="{{ url($blog->feature_image) }}" alt="">
                        <div class="blog-author">
                            <span><i class="fas fa-user"></i> {{ $website_lang->where('lang_key','admin')->first()->custom_lang }}</span>
                            <span><i class="far fa-calendar-alt"></i> {{ $blog->created_at->format('m-d-Y') }}</span>
                            <span><i class="fas fa-tag" aria-hidden="true"></i> <a href="{{ url('blog-category/'.$blog->category->slug) }}" class="text-white"> {{ $blog->category->name }}</a></span>
                        </div>
                    </div>
                    <div class="blog-text pt_40">
                        <p>
                            {!! clean($blog->sort_description) !!}
                        </p>

                        {!! clean($blog->description) !!}
                    </div>
                </div>
                @if ($setting->comment_type==0)
                <div class="comment-list mt_30">
                    <h4>{{ $website_lang->where('lang_key','comments')->first()->custom_lang }}</h4>
                </div>
                <div class="fb-comments" data-href="{{ Request::url() }}" data-width="" data-numposts="10"></div>
                @else
                <div class="comment-list mt_30">
                    @if ($blog->comments->where('status',1)->count() !=0)
                        <h4>{{ $website_lang->where('lang_key','comments')->first()->custom_lang }} <span class="c-number">({{ $blog->comments->where('status',1)->count() }})</span></h4>
                    @endif

                    <ul>
                        @foreach ($blog->comments->where('status',1) as $comment)
                        <li>
                            <div class="comment-item">
                                <div class="thumb">
                                    @php
                                    $gravatar_link = 'http://www.gravatar.com/avatar/' . md5($comment->email) . '?s=32';
                                    header("content-type: image/jpeg");
                                    @endphp
                                    <img src="{{ $gravatar_link }}" alt="">
                                </div>
                                <div class="com-text">
                                    <h5>{{ ucwords($comment->name) }}</h5>
                                    <span class="date"><i class="fas fa-calendar"></i>{{ date('d F, Y', strtotime($comment->created_at->format('Y-m-d'))) }}</span>
                                    <p>
                                        {{ $comment->comment }}
                                    </p>
                                </div>
                            </div>
                        </li>

                        @endforeach

                    </ul>
                </div>
                <div class="comment-form mt_30">
                    <h4>{{ $website_lang->where('lang_key','submit_comment')->first()->custom_lang }}</h4>
                    <form method="POST" action="{{ url('comment-store') }}">
                        @csrf
                        <div class="form-row row">
                            <div class="form-group col-md-12">
                                <input type="text" class="form-control" name="name" placeholder="{{ $website_lang->where('lang_key','name')->first()->custom_lang }}">
                                <input type="hidden" class="form-control" name="blog_id" value="{{ $blog->id }}" value="{{ old('name') }}">
                            </div>
                            <div class="form-group col-md-12">
                                <input type="text" class="form-control" name="email" placeholder="{{ $website_lang->where('lang_key','email')->first()->custom_lang }}" value="{{ old('email') }}">
                            </div>
                            <div class="form-group col-md-12">
                                <input type="text" value="{{ old('phone') }}" class="form-control" name="phone" placeholder="{{ $website_lang->where('lang_key','phone')->first()->custom_lang }}">
                            </div>
                            <div class="form-group col-12">
                                <textarea class="form-control" name="comment" placeholder="{{ $website_lang->where('lang_key','comment')->first()->custom_lang }}">{{ old('comment') }}</textarea>
                            </div>
                            @if($setting->allow_captcha==1)
                            <div class="form-group col-12">
                                <div class="g-recaptcha" data-sitekey="{{ $setting->captcha_key }}"></div>
                            </div>
                            @endif
                            <div class="form-group col-md-12">
                                <button type="submit" class="btn">{{ $website_lang->where('lang_key','submit')->first()->custom_lang }}</button>
                            </div>
                        </div>
                    </form>
                </div>
                @endif

            </div>
            <div class="col-lg-4">
                <div class="sidebar">
                    <div class="sidebar-item">
                        <h3>{{ $website_lang->where('lang_key','blog_category')->first()->custom_lang }}</h3>
                        <ul>
                            @foreach ($blogCategories as $category)
                                <li class="{{ $blog->blog_category_id==$category->id ? 'active' :'' }}"><a href="{{ url('blog-category/'.$category->slug) }}"><i class="fas fa-chevron-right"></i>{{ $category->name }}</a></li>
                            @endforeach


                        </ul>
                    </div>
                    <div class="sidebar-item">
                        <h3>{{ $website_lang->where('lang_key','recent_posts')->first()->custom_lang }}</h3>
                        @foreach ($latestBlog as $item)
                            <div class="blog-recent-item">
                                <div class="blog-recent-photo">
                                    <a href="{{ url('blog-details/'.$item->slug) }}"><img src="{{ url($item->thumbnail_image) }}" alt=""></a>
                                </div>
                                <div class="blog-recent-text">
                                    <a href="{{ url('blog-details/'.$item->slug) }}">{{ $item->title }}</a>
                                    <div class="blog-post-date">{{ $item->created_at->format('m-d-Y') }}</div>
                                </div>
                            </div>
                        @endforeach


                    </div>
                </div>
                <!--Sidebar End-->
            </div>
        </div>
    </div>
</div>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v11.0&appId={{ $setting->facebook_comment_script }}&autoLogAppEvents=1" nonce="MoLwqHe5"></script>
@endsection
