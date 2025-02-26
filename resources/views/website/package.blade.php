
@extends('website.layout.master')

@section('main_content')

			<!-- Banner Section -->
            <section class="inner-banner">
                <div class="image-layer" style="background-image: url({{asset('uploads/'.$package->banner)}});">
                </div>
                <div class="auto-container">
                    <div class="content-box">
                        <h1>{{$package->packageTitle->title_en}}</h1>
                    </div>
                </div>
            </section>
            <!--End Banner Section -->
    
            <!--Packages Section-->
            <section class="packages-three">
               
                <div class="auto-container">
                    <div class="packages mt-5">
                        <div class="row clearfix">
                            <!--Block-->
                            @foreach ($private_tours as $item)
                            
                                <div class="package-block col-lg-4 col-md-6 col-sm-12">
                                    <a href="{{ route('tour', ['lang' => app()->getLocale(), 'cooperator' => request()->segment(2), 'id' => $item->id]) }}">
                                    <div class="inner-box">
                                        <div class="image-box">
                                            <div class="image"><img
                                                        src="{{asset('uploads/'.$item->tourTitle->photo)}}"
                                                        alt="Helsinki">
                                            </div>
                                        </div>
                                        <div class="lower-box">
                                            
                                            <div class="location">{{$item->tourTitle->title_en}}</div>
                                            {{-- <h5><a href="tour-single.html">{{$item->tour_name}}</a></h5> --}}
                                            <div class="info clearfix">
                                                <div class="duration"><i class="fa-solid fa-clock"></i> {{$package->packageTitle->title_en}}</div>
                                                <div class="persons"><i class="fa-solid fa-user"></i> 2</div>
                                            </div>
                                            <div class="bottom-box clearfix">
                                                <div class="rating"><a href="#" class="theme-btn"><i
                                                            class="fa-solid fa-star"></i>
                                                        <strong>4.8</strong> &ensp; <span class="count">4570 Reviews</span></a>
                                                </div>
                                                <div class="price">Start from &ensp;<span class="amount">${{$item->total_price}}</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </a> 
                                </div> 
                             
                            @endforeach
                        </div>
    
                       <!-- Pagination -->
                        <div class="styled-pagination centered">
                            <ul class="clearfix">
                                <!-- Previous Page Link -->
                                @if (!$private_tours->onFirstPage())
                                    <li><a href="{{ $private_tours->previousPageUrl() }}"><i class="fa-solid fa-angle-left"></i></a></li>
                                @endif

                                <!-- Pagination Elements -->
                                @foreach ($private_tours->getUrlRange(1, $private_tours->lastPage()) as $page => $url)
                                    @if ($page == $private_tours->currentPage())
                                        <li class="active"><a href="#">{{ $page }}</a></li>
                                    @else
                                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                                    @endif
                                @endforeach

                                <!-- Next Page Link -->
                                @if ($private_tours->hasMorePages())
                                    <li><a href="{{ $private_tours->nextPageUrl() }}"><i class="fa-solid fa-angle-right"></i></a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </section>

@endsection