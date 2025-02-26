
@extends('website.layout.master')

@section('main_content')


<!-- Banner Section -->
<section class="inner-banner">
    <div class="image-layer" style="background-image: url({{asset('uploads/'.$destinations_banner)}});">
    </div>
    <div class="auto-container">
        <div class="content-box">
            <h1>@lang('common.destinations')</h1>
            <div class="bread-crumb">
                <ul class="clearfix">
                    <li><a href="{{ route('home.lang', ['lang' => request()->segment(1), 'cooperator' => $cooperator->slug]) }}">@lang('common.home')</a></li>
                    <li class="current">@lang('common.destinations')</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!--End Banner Section -->

<!--Destinations Section-->
<section class="destinations-two">
    <div class="auto-container">
        <div class="packages">
            <div class="row clearfix">
                <!--Block-->
                @foreach ($destinations as $item)
                    <div class="popular-block col-xl-3 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                        <div class="inner-box">
                            <div class="image-box">
                                <div class="image"><a href="{{ route('destination', ['lang' => app()->getLocale(), 'cooperator' => request()->segment(2), 'slug' => $item->slug]) }}"><img
                                            src="{{asset('uploads/'.$item->featured_photo)}}" alt="{{$item->name_en}}"></a>
                                </div>
                            </div>
                            <div class="hvr-box">
                                <div class="hvr-inner">
                                    <h3>
                                        <a href="{{ route('destination', ['lang' => app()->getLocale(), 'cooperator' => request()->segment(2), 'slug' => $item->slug]) }}">
                                            @if(app()->getLocale() === 'ar')
                                                {{$item->name_ar}}				
                                            @elseif(app()->getLocale() === 'ru')
                                                {{$item->name_ru}}
											@else
                                                {{$item->name_en}}
											@endif 
                                        </a>
                                    </h3>
                                    <div class="info">
                                        <span>{{$item->cities->count()}} Cities</span> 
                                        <span>{{$item->accommodations->count()}} Hotels</span>
                                        <span>{{$item->packages->count()}} Packages</span> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                @endforeach
               
                
            </div>

            {{-- pagination --}}
            <div class="styled-pagination centered">
                <ul class="clearfix">
                    <!-- Previous Page Link -->
                    @if (!$destinations->onFirstPage())
                        <li><a href="{{ $destinations->previousPageUrl() }}"><i class="fa-solid fa-angle-left"></i></a></li>
                    @endif
            
                    <!-- Pagination Elements -->
                    @foreach ($destinations->getUrlRange(1, $destinations->lastPage()) as $page => $url)
                        @if ($page == $destinations->currentPage())
                            <li class="active"><a href="#">{{ $page }}</a></li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
            
                    <!-- Next Page Link -->
                    @if ($destinations->hasMorePages())
                        <li><a href="{{ $destinations->nextPageUrl() }}"><i class="fa-solid fa-angle-right"></i></a></li>
                    @endif
                </ul>
            </div>
            
            
        </div>
    </div>
</section>


@endsection