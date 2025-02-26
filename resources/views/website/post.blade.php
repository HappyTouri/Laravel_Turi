@extends('website.layout.master')

@section('main_content')
@php
    $setting=App\Models\Setting::where('id',1)->first();
@endphp

<!-- Banner Section -->
<section class="blog-single-banner">
    <div class="image-layer" style="background-image: url({{asset('uploads/'.$post->banner)}});">
    </div>
    <div class="auto-container">
        <div class="content-box">
            <div class="content">
                <h1>
                    @if(app()->getLocale() === 'ar')
                        {{$post->title_ar}}
                    @elseif(app()->getLocale() === 'ru')
                        {{$post->title_ru}}
                    @else
                        {{$post->title_en}}
                    @endif
                </h1>
                <ul class="info clearfix">
                    <li>
                        <a href="#"><i class="fa-solid fa-folder"></i> 
                        @if(app()->getLocale() === 'ar')
                            {{$post->blog_category->name_ar}}
                        @elseif(app()->getLocale() === 'ru')
                            {{$post->blog_category->name_ru}}
                        @else
                            {{$post->blog_category->name_en}}
                        @endif
                    </a>
                    </li>
       
                    <li><a href="#"><i class="fa-solid fa-clock"></i> {{ $post->created_at->format('F j, Y') }}</a></li>
    
                </ul>
            </div>
        </div>
    </div>
</section>
<!--End Banner Section -->

<!--Sidebar Container-->
<div class="sidebar-container blog-page">
    <div class="auto-container">
        <div class="row clearfix">

            <!--Content Side-->
            <div class="content-side col-xl-8 col-lg-8 col-md-12 col-sm-12">
                <div class="content-inner">

                    <div class="post-details">
                        <div class="text-content">
                            <p>
                            @if(app()->getLocale() === 'ar')
                                {!!$post->description_ar!!}
                            @elseif(app()->getLocale() === 'ru')
                                {!!$post->description_ru!!}
                            @else
                                {!!$post->description_en!!}
                            @endif
                                
                            </p>
                        </div>
                        <div class="more-links clearfix">
                            <div class="tags">
                                <a href="">
                                    @if(app()->getLocale() === 'ar')
                                        {{$post->blog_category->name_ar}}
                                    @elseif(app()->getLocale() === 'ru')
                                        {{$post->blog_category->name_ru}}
                                    @else
                                        {{$post->blog_category->name_en}}
                                    @endif
                                </a> 
                                
                            </div>
                            <div class="social"><strong>Share</strong> <a href="#" class="facebook"><i
                                        class="fab fa-facebook-f"></i></a> <a href="#" class="twitter"><i
                                        class="fab fa-twitter"></i></a> <a href="#" class="linkedin"><i
                                        class="fab fa-linkedin-in"></i></a></div>
                        </div>
                    </div>

                    
                </div>
            </div>

            <!--Sidebar Side-->
            <div class="sidebar-side col-xl-4 col-lg-4 col-md-12 col-sm-12">
                <div class="sidebar-inner">
                   
                    <!--Widget-->
                    <div class="sb-widget posts-widget">
                        <div class="w-inner">
                            <div class="s-title"><i class="fa-solid fa-caret-right"></i>
                                <h4>@lang('common.Recent Posts')</h4>
                            </div>
                            <div class="posts">
                                @foreach ($latest_posts as $item)
                                    <div class="post">
                                        <div class="post-thumb"><a href="{{ route('post', ['lang' => app()->getLocale(), 'slug' => $item->slug]) }}"><img
                                                    src="{{asset('uploads/'.$item->photo)}}"
                                                    alt="{{$item->title_en}}"></a></div>
                                        <div class="travilo-text">
                                            <a href="{{ route('post', ['lang' => app()->getLocale(), 'slug' => $item->slug]) }}">
                                                @if(app()->getLocale() === 'ar')
                                                    {{$item->title_ar}}
                                                @elseif(app()->getLocale() === 'ru')
                                                    {{$item->title_ru}}
                                                @else
                                                    {{$item->title_en}}
                                                @endif
                                            </a>
                                        </div>
                                        <div class="post-info">{{ $item->created_at->format('F j, Y') }}</div>
                                    </div>   
                                @endforeach
                                
                                
                            </div>
                        </div>
                    </div>

                    

                  

                </div>
            </div>

        </div>
    </div>
</div>

@endsection