@extends('website.layout.master')

@section('main_content')
@php
    $setting=App\Models\Setting::where('id',1)->first();
@endphp

<!-- Banner Section -->
<section class="inner-banner">
    <div class="image-layer" style="background-image: url({{asset('uploads/'.$blog_banner)}});">
    </div>
    <div class="auto-container">
        <div class="content-box">
            <h1>@lang('common.Latest News')</h1>
            <div class="bread-crumb">
                <ul class="clearfix">
                    <li><a href="{{ route('home.lang', ['lang' => request()->segment(1), 'cooperator' => $cooperator->slug]) }}">@lang('common.home')</a></li>
                    <li class="current">@lang('common.Latest News')</li>
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
            <div class="content-side col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="content-inner">

                    <div class="news">
                        <div class="row">
                            <!--Block-->
                            @foreach ($posts as $item)
                            <div class="content-side col-xl-4 col-lg-4 col-md-4 col-sm-12">
                                <div class="news-block-three wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="0ms">
                                    <div class="inner-box">
                                        <div class="image-box">
                                            <a href="{{ route('post', ['lang' => app()->getLocale(), 'cooperator' => request()->segment(2), 'slug' => $item->slug]) }}">
                                                <img src="{{asset('uploads/'.$item->photo)}}" alt="Balloons">
                                            </a>
                                        </div>
                                        <div class="lower-box">
                                            <ul class="info clearfix {{ app()->getLocale() === 'ar' ? 'text-end' : 'text-start' }}">
                                                <li>
                                                    <a href="{{ route('post', ['lang' => app()->getLocale(), 'cooperator' => request()->segment(2), 'slug' => $item->slug]) }}">
                                                        <i class="fa-solid fa-folder"></i>
                                                        @if(app()->getLocale() === 'ar')
                                                            {{$item->blog_category->name_ar}}
                                                        @elseif(app()->getLocale() === 'ru')
                                                            {{$item->blog_category->name_ru}}
                                                        @else
                                                            {{$item->blog_category->name_en}}
                                                        @endif
                                                    </a>
                                                </li>
                                                <li>
                                                    <i class="fa-solid fa-clock"></i>{{ $item->created_at->format('F j, Y') }}
                                                </li>
                                            </ul>
                                            <h3 class="{{ app()->getLocale() === 'ar' ? 'text-end' : 'text-start' }}">
                                                <a href="{{ route('post', ['lang' => app()->getLocale(), 'cooperator' => request()->segment(2), 'slug' => $item->slug]) }}">
                                                    @if(app()->getLocale() === 'ar')
                                                        {{$item->title_ar}}
                                                    @elseif(app()->getLocale() === 'ru')
                                                        {{$item->title_ru}}
                                                    @else
                                                        {{$item->title_en}}
                                                    @endif
                                                </a>
                                            </h3>
                                            <div class="travilo-text {{ app()->getLocale() === 'ar' ? 'text-end' : 'text-start' }}">
                                                @if(app()->getLocale() === 'ar')
                                                    {{$item->short_description_ar}}
                                                @elseif(app()->getLocale() === 'ru')
                                                    {{$item->short_description_ru}}
                                                @else
                                                    {{$item->short_description_en}}
                                                @endif
                                            </div>
                                            <div class="more-links clearfix {{ app()->getLocale() === 'ar' ? 'text-end' : 'text-start' }}">
                                                <div class="more">
                                                    <a href="{{ route('post', ['lang' => app()->getLocale(), 'cooperator' => request()->segment(2), 'slug' => $item->slug]) }}" class="theme-btn btn-style-two float-{{ app()->getLocale() === 'ar' ? 'end' : 'start' }}">
                                                        <span>@lang('common.Read More')</span>
                                                    </a>
                                                </div>
                                                <div class="social">
                                                    <strong>Share</strong>
                                                    <a href="https://www.facebook.com/sharer/sharer.php?u=YOUR_PAGE_URL" target="_blank" class="facebook">
                                                        <i class="fab fa-facebook-f"></i>
                                                    </a>
                                                    <a href="https://twitter.com/intent/tweet?url=YOUR_PAGE_URL" target="_blank" class="twitter">
                                                        <i class="fab fa-twitter"></i>
                                                    </a>
                                                    <a href="https://www.linkedin.com/shareArticle?url=YOUR_PAGE_URL" target="_blank" class="linkedin">
                                                        <i class="fab fa-linkedin-in"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             
                            @endforeach 
                        </div>
                    </div>

                    <div class="styled-pagination centered">
                        <ul class="clearfix">
                            <!-- Previous Page Link -->
                            @if (!$posts->onFirstPage())
                                <li><a href="{{ $posts->previousPageUrl() }}"><i class="fa-solid fa-angle-left"></i></a></li>
                            @endif
                    
                            <!-- Pagination Elements -->
                            @foreach ($posts->getUrlRange(1, $posts->lastPage()) as $page => $url)
                                @if ($page == $posts->currentPage())
                                    <li class="active"><a href="#">{{ $page }}</a></li>
                                @else
                                    <li><a href="{{ $url }}">{{ $page }}</a></li>
                                @endif
                            @endforeach
                    
                            <!-- Next Page Link -->
                            @if ($posts->hasMorePages())
                                <li><a href="{{ $posts->nextPageUrl() }}"><i class="fa-solid fa-angle-right"></i></a></li>
                            @endif
                        </ul>
                    </div>
                    

                </div>
            </div>

            {{-- <!--Sidebar Side-->
            <div class="sidebar-side col-xl-4 col-lg-5 col-md-12 col-sm-12">
                <div class="sidebar-inner">
                    <!--Widget-->
                    <div class="sb-widget search-widget">
                        <div class="w-inner">
                            <div class="s-title"><i class="fa-solid fa-caret-right"></i>
                                <h4>Search</h4>
                            </div>
                            <form method="post" action="contact.html">
                                <div class="form-group">
                                    <input type="search" name="search-field" value=""
                                        placeholder="Type your keyword" required>
                                    <button type="submit"><span class="icon fa fa-search"></span></button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!--Widget-->
                    <div class="sb-widget posts-widget">
                        <div class="w-inner">
                            <div class="s-title"><i class="fa-solid fa-caret-right"></i>
                                <h4>Recent Posts</h4>
                            </div>
                            <div class="posts">
                                <div class="post">
                                    <div class="post-thumb"><a href="blog-single.html"><img
                                                src="assets/images/resources/gallery/oman-12-thumb.jpg"
                                                alt="Salalah"></a></div>
                                    <div class="travilo-text"><a href="blog-single.html">Salalah, A Tropical
                                            Paradise in Oman</a>
                                    </div>
                                    <div class="post-info">August 3 2023</div>
                                </div>
                                <div class="post">
                                    <div class="post-thumb"><a href="blog-single.html"><img
                                                src="assets/images/resources/gallery/gallery-thumb-1.jpg"
                                                alt="New York"></a></div>
                                    <div class="travilo-text"><a href="blog-single.html">Exploring the New York
                                            Architectural
                                            Marvels</a></div>
                                    <div class="post-info">July 28 2023</div>
                                </div>
                                <div class="post">
                                    <div class="post-thumb"><a href="blog-single.html"><img
                                                src="assets/images/resources/gallery/gallery-thumb-2.jpg"
                                                alt="Sydney"></a></div>
                                    <div class="travilo-text"><a href="blog-single.html">The Vibrant Harbor City
                                            Down Under</a></div>
                                    <div class="post-info">July 24 2023</div>
                                </div>
                                <div class="post">
                                    <div class="post-thumb"><a href="blog-single.html"><img
                                                src="assets/images/resources/gallery/gallery-thumb-3.jpg"
                                                alt="India"></a></div>
                                    <div class="travilo-text"><a href="blog-single.html">India's Majestic
                                            Monument of Love</a></div>
                                    <div class="post-info">July 24 2023</div>
                                </div>
                                <div class="post">
                                    <div class="post-thumb"><a href="blog-single.html"><img
                                                src="assets/images/resources/gallery/gallery-thumb-4.jpg"
                                                alt="Morocco"></a></div>
                                    <div class="travilo-text"><a href="blog-single.html">Morocco Beach Sun,
                                            Sand, and Serenity</a>
                                    </div>
                                    <div class="post-info">July 22 2023</div>
                                </div>
                                <div class="post">
                                    <div class="post-thumb"><a href="blog-single.html"><img
                                                src="assets/images/resources/gallery/gallery-thumb-5.jpg"
                                                alt="Italy"></a></div>
                                    <div class="travilo-text"><a href="blog-single.html">Lakeside Tranquility
                                            and Italian Charm</a>
                                    </div>
                                    <div class="post-info">July 12 2023</div>
                                </div>
                                <div class="post">
                                    <div class="post-thumb"><a href="blog-single.html"><img
                                                src="assets/images/resources/gallery/gallery-thumb-6.jpg"
                                                alt="India"></a></div>
                                    <div class="travilo-text"><a href="blog-single.html">A Fusion of Cultures
                                            and Wonders Await!</a>
                                    </div>
                                    <div class="post-info">June 30 2023</div>
                                </div>
                                <div class="post">
                                    <div class="post-thumb"><a href="blog-single.html"><img
                                                src="assets/images/resources/gallery/gallery-thumb-7.jpg"
                                                alt="London"></a></div>
                                    <div class="travilo-text"><a href="blog-single.html">Discovering Historic
                                            Landmarks in the UK</a>
                                    </div>
                                    <div class="post-info">June 29 2023</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--Widget-->
                    <div class="sb-widget links-widget">
                        <div class="w-inner">
                            <div class="s-title"><i class="fa-solid fa-caret-right"></i>
                                <h4>Categories</h4>
                            </div>
                            <ul>
                                <li><a href="#">Adventure</a></li>
                                <li><a href="#">Hiking</a></li>
                                <li><a href="#">Romance</a></li>
                                <li><a href="#">Culture</a></li>
                                <li><a href="#">City Tour</a></li>
                                <li><a href="#">History</a></li>
                                <li><a href="#">Beach Tour</a></li>
                                <li><a href="#">Sports Tour</a></li>
                                <li><a href="#">Relaxation</a></li>
                            </ul>
                        </div>
                    </div>

                    <!--Widget-->
                    <div class="sb-widget tags-widget">
                        <div class="w-inner">
                            <div class="s-title"><i class="fa-solid fa-caret-right"></i>
                                <h4>Tags</h4>
                            </div>
                            <ul>
                                <li><a href="#">Fishing</a></li>
                                <li><a href="#">Cooking</a></li>
                                <li><a href="#">Art</a></li>
                                <li><a href="#">Mountain</a></li>
                                <li><a href="#">Family</a></li>
                                <li><a href="#">Bike</a></li>
                                <li><a href="#">Luxury</a></li>
                                <li><a href="#">Sports</a></li>
                                <li><a href="#">Cycling</a></li>
                            </ul>
                        </div>
                    </div>

                    <!--Widget-->
                    <div class="sb-widget gallery-widget">
                        <div class="w-inner">
                            <div class="s-title"><i class="fa-solid fa-caret-right"></i>
                                <h4>Gallery</h4>
                            </div>
                            <ul class="clearfix">
                                <li>
                                    <div class="image"><a href="assets/images/resources/gallery/gallery-1.jpg"
                                            class="lightbox-image" data-fancybox="SbGallery"><img
                                                src="assets/images/resources/gallery/gallery-1-thumb.jpg"
                                                alt=""></a>
                                    </div>
                                </li>
                                <li>
                                    <div class="image"><a href="assets/images/resources/gallery/gallery-2.jpg"
                                            class="lightbox-image" data-fancybox="SbGallery"><img
                                                src="assets/images/resources/gallery/gallery-2-thumb.jpg"
                                                alt=""></a>
                                    </div>
                                </li>
                                <li>
                                    <div class="image"><a href="assets/images/resources/gallery/gallery-3.jpg"
                                            class="lightbox-image" data-fancybox="SbGallery"><img
                                                src="assets/images/resources/gallery/gallery-3-thumb.jpg"
                                                alt=""></a>
                                    </div>
                                </li>
                                <li>
                                    <div class="image"><a href="assets/images/resources/gallery/gallery-4.jpg"
                                            class="lightbox-image" data-fancybox="SbGallery"><img
                                                src="assets/images/resources/gallery/gallery-4-thumb.jpg"
                                                alt=""></a>
                                    </div>
                                </li>
                                <li>
                                    <div class="image"><a href="assets/images/resources/gallery/gallery-5.jpg"
                                            class="lightbox-image" data-fancybox="SbGallery"><img
                                                src="assets/images/resources/gallery/gallery-5-thumb.jpg"
                                                alt=""></a>
                                    </div>
                                </li>
                                <li>
                                    <div class="image"><a href="assets/images/resources/gallery/gallery-6.jpg"
                                            class="lightbox-image" data-fancybox="SbGallery"><img
                                                src="assets/images/resources/gallery/gallery-6-thumb.jpg"
                                                alt=""></a>
                                    </div>
                                </li>
                                <li>
                                    <div class="image"><a href="assets/images/resources/gallery/gallery-7.jpg"
                                            class="lightbox-image" data-fancybox="SbGallery"><img
                                                src="assets/images/resources/gallery/gallery-7-thumb.jpg"
                                                alt=""></a>
                                    </div>
                                </li>
                                <li>
                                    <div class="image"><a href="assets/images/resources/gallery/gallery-8.jpg"
                                            class="lightbox-image" data-fancybox="SbGallery"><img
                                                src="assets/images/resources/gallery/gallery-8-thumb.jpg"
                                                alt=""></a>
                                    </div>
                                </li>
                                <li>
                                    <div class="image"><a href="assets/images/resources/gallery/gallery-9.jpg"
                                            class="lightbox-image" data-fancybox="SbGallery"><img
                                                src="assets/images/resources/gallery/gallery-9-thumb.jpg"
                                                alt=""></a>
                                    </div>
                                </li>
                                <li>
                                    <div class="image"><a href="assets/images/resources/gallery/gallery-10.jpg"
                                            class="lightbox-image" data-fancybox="SbGallery"><img
                                                src="assets/images/resources/gallery/gallery-10-thumb.jpg"
                                                alt=""></a>
                                    </div>
                                </li>
                                <li>
                                    <div class="image"><a href="assets/images/resources/gallery/gallery-11.jpg"
                                            class="lightbox-image" data-fancybox="SbGallery"><img
                                                src="assets/images/resources/gallery/gallery-11-thumb.jpg"
                                                alt=""></a>
                                    </div>
                                </li>
                                <li>
                                    <div class="image"><a href="assets/images/resources/gallery/gallery-12.jpg"
                                            class="lightbox-image" data-fancybox="SbGallery"><img
                                                src="assets/images/resources/gallery/gallery-12-thumb.jpg"
                                                alt=""></a>
                                    </div>
                                </li>
                                <li>
                                    <div class="image"><a href="assets/images/resources/gallery/gallery-13.jpg"
                                            class="lightbox-image" data-fancybox="SbGallery"><img
                                                src="assets/images/resources/gallery/gallery-13-thumb.jpg"
                                                alt=""></a>
                                    </div>
                                </li>
                                <li>
                                    <div class="image"><a href="assets/images/resources/gallery/gallery-14.jpg"
                                            class="lightbox-image" data-fancybox="SbGallery"><img
                                                src="assets/images/resources/gallery/gallery-14-thumb.jpg"
                                                alt=""></a>
                                    </div>
                                </li>
                                <li>
                                    <div class="image"><a href="assets/images/resources/gallery/gallery-15.jpg"
                                            class="lightbox-image" data-fancybox="SbGallery"><img
                                                src="assets/images/resources/gallery/gallery-15-thumb.jpg"
                                                alt=""></a>
                                    </div>
                                </li>
                                <li>
                                    <div class="image"><a href="assets/images/resources/gallery/gallery-16.jpg"
                                            class="lightbox-image" data-fancybox="SbGallery"><img
                                                src="assets/images/resources/gallery/gallery-16-thumb.jpg"
                                                alt=""></a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!--Widget-->
                    <div class="sb-widget social-widget">
                        <div class="w-inner">
                            <div class="s-title"><i class="fa-solid fa-caret-right"></i>
                                <h4>Follow Us</h4>
                            </div>
                            <ul class="social-links clearfix">
                                <li><a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#" class="twitter"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#" class="linkedin"><i class="fab fa-linkedin-in"></i></a></li>
                                <li><a href="#" class="youtube"><i class="fab fa-youtube"></i></a></li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div> --}}

        </div>
    </div>
</div>

@endsection