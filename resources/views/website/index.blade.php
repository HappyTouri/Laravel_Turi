
@extends('website.layout.master')

@section('main_content')



		<!-- Banner Section -->
		<div class="banner-two">
			<div class="banner-container">
				<div class="banner-slider">
					<div class="swiper-wrapper">
						<!--Slide Item-->
                        @foreach ($sliders as $item)
                        <div class="swiper-slide slide-item">
							<div class="image-layer"
								style="background-image: url({{asset('uploads/'.$item->photo)}});"></div>
							<div class="auto-container">
								<div class="content-box">
									<div class="content">
										<div class="clearfix">
											<div class="inner">
												<h1>
													<span>
														@if(app()->getLocale() === 'ar')
															{{ $item->heading_ar }}
														@elseif(app()->getLocale() === 'ru')
															{{ $item->heading_ru }}
														@else
															{{ $item->heading_en }}
														@endif
														<i class="s-text">
															@if(app()->getLocale() === 'ar')
																{{ $item->heading_ar }}
															@elseif(app()->getLocale() === 'ru')
																{{ $item->heading_ru }}
															@else
																{{ $item->heading_en }}
															@endif
														</i>
													</span>
												</h1>
												<div class="travilo-text">
													@if(app()->getLocale() === 'ar')
														{{ $item->text_ar }}
													@elseif(app()->getLocale() === 'ru')
														{{ $item->text_ru }}
													@else
														{{ $item->text_en }}
													@endif
												</div>
												<div class="links-box clearfix">
													<div class="link">
														<a href="{{ route('destinations', ['lang' => request()->segment(1), 'cooperator' => $cooperator->slug]) }}" class="theme-btn btn-style-two">
															<span>
																@lang('common.Explore Now')
															</span>
														</a>
													</div>
													<div class="link">
														<a href="{{ route('about', ['lang' => request()->segment(1), 'cooperator' => $cooperator->slug]) }}" class="theme-btn btn-style-three">
															<span>
																@lang('common.About Us')
															</span>
														</a>
													</div>
												</div>
											</div>

										</div>
									</div>
								</div>
							</div>
						</div>  
                        @endforeach
						
					</div>
					<div class="swiper-button-prev"><span class="fa-solid fa-angle-left"></span></div>
					<div class="swiper-button-next"><span class="fa-solid fa-angle-right"></span></div>
				</div>
			</div>
		</div>
		<!--End Banner Section -->


		<!--Destination-->
		<div class="popular-section">
			<div class="auto-container">
				<div class="title-box wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
					<div class="subtitle">Start Travelling Today</div>
					<h2><span>@lang('common.Popular Destinations')</span></h2>
				</div>
				<div class="carousel-box wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
					<div class="bg-grad-left"><img src="{{asset('assets/images/background/bg-gradient-15.png')}}" alt="" title="">
					</div>
					<div class="bg-grad-right"><img src="{{asset('assets/images/background/bg-gradient-16.png')}}" alt="" title="">
					</div>
					<div class="d-elem-1"><img src="{{asset('assets/images/elements/purple-2.png')}}" alt=""></div>
					<div class="popular-carousel">
						<!--Block-->
						@foreach ($destinations as $item)
							<div class="popular-block {{ $loop->even ? 'alternate' : '' }} col-xl-3 col-lg-4 col-md-6 col-sm-6 col-xs-12">
								<div class="inner-box">
									<div class="image-box">
										<div class="image">
											<a href="{{ route('destination', ['lang' => app()->getLocale(), 'cooperator' => $cooperator->slug, 'slug' => $item->slug]) }}">
												<img src="{{ asset('uploads/'.$item->featured_photo) }}" alt="{{ $item->name_en }}">
											</a>
										</div>
									</div>
									<div class="hvr-box">
										<div class="hvr-inner">
											<h3>
												<a href="{{ route('destination', ['lang' => app()->getLocale(), 'cooperator' => $cooperator->slug, 'slug' => $item->slug]) }}">
													@if(app()->getLocale() === 'ar')
														{{ $item->name_ar }}
													@elseif(app()->getLocale() === 'ru')
														{{ $item->name_ru }}
													@else
														{{ $item->name_en }}
													@endif 
												</a>
											</h3>
											<div class="info">
												<span>{{ $item->cities->count() }} Cities</span> 
												<span>{{ $item->accommodations->count() }} Hotels</span>
												<span>{{ $item->packages->count() }} Packages</span> 
											</div>
										</div>
									</div>
								</div>
							</div> 
						@endforeach
					</div>
				</div>
			</div>
		</div>

		<!--Let’s Travel Now-->
		<div class="bg-layer pt-5" style="background-image: url({{asset('assets/images/background/pattern-3.jpg')}});">
			<div class="intro-section no-padd-top">
				<div class="auto-container">
					<div class="title-box centered wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
						<div class="subtitle">Let’s Travel Now</div>
						<h2><span>@lang('common.Explore the World')</span></h2>
					</div>
					<div class="row clearfix justify-content-center">
						<!--Block-->
						<div class="intro-block col-lg-4 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="0ms"
							data-wow-duration="1500ms">
							<div class="inner-box">
								<div class="icon"><span><img src="{{asset('uploads/'.$home_items->travel_icon_1)}}" alt=""></span></div>
								<h4>
									@if(app()->getLocale() === 'ar')
                                        {{$home_items->title_1_ar}}				
                                    @elseif(app()->getLocale() === 'ru')
                                        {{$home_items->title_1_ru}}
									@else
                                        {{$home_items->title_1_en}}
									@endif 
								</h4>
								<p class="travilo-text">
									@if(app()->getLocale() === 'ar')
                                        {{$home_items->description_1_ar}}				
                                    @elseif(app()->getLocale() === 'ru')
                                        {{$home_items->description_1_ru}}
									@else
                                        {{$home_items->description_1_en}}
									@endif 
								</p>
							</div>
						</div>
						<!--Block-->
						<div class="intro-block col-lg-4 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="300ms"
							data-wow-duration="1500ms">
							<div class="inner-box">
								<div class="icon"><span><img src="{{asset('uploads/'.$home_items->travel_icon_2)}}" alt=""></span></div>
								<h4>
									@if(app()->getLocale() === 'ar')
                                        {{$home_items->title_2_ar}}				
                                    @elseif(app()->getLocale() === 'ru')
                                        {{$home_items->title_2_ru}}
									@else
                                        {{$home_items->title_2_en}}
									@endif 
								</h4>
								<p class="travilo-text">
									@if(app()->getLocale() === 'ar')
                                        {{$home_items->description_2_ar}}				
                                    @elseif(app()->getLocale() === 'ru')
                                        {{$home_items->description_2_ru}}
									@else
                                        {{$home_items->description_2_en}}
									@endif 
								</p>
							</div>
						</div>
						<!--Block-->
						<div class="intro-block col-lg-4 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="600ms"
							data-wow-duration="1500ms">
							<div class="inner-box">
								<div class="icon"><span><img src="{{asset('uploads/'.$home_items->travel_icon_3)}}" alt=""></span></div>
								<h4>
									@if(app()->getLocale() === 'ar')
                                        {{$home_items->title_3_ar}}				
                                    @elseif(app()->getLocale() === 'ru')
                                        {{$home_items->title_3_ru}}
									@else
                                        {{$home_items->title_3_en}}
									@endif 
								</h4>
								<p class="travilo-text">
									@if(app()->getLocale() === 'ar')
                                        {{$home_items->description_3_ar}}				
                                    @elseif(app()->getLocale() === 'ru')
                                        {{$home_items->description_3_ru}}
									@else
                                        {{$home_items->description_3_en}}
									@endif 
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


		<!--Let’s Explore the World-->
		<div class="about-two">
			<div class="bg-grad-right"><img src="{{asset('assets/images/background/bg-gradient-18.png')}}" alt="" title=""></div>
			<div class="auto-container">
				<div class="outer-box">
					<div class="d-elem-1"><img src="{{asset('assets/images/elements/green-2.png')}}" alt=""></div>
					<div class="bg-grad-left"><img src="{{asset('assets/images/background/bg-gradient-17.png')}}" alt="" title="">
					</div>
					<div class="row clearfix">
						<!--Text Col-->
						<div class="text-col col-lg-7 col-md-12 col-sm-12">
							<div class="inner wow fadeInRight" data-wow-duration="1500ms" data-wow-delay="0ms">
								<div class="title-box">
									<div class="subtitle">Let’s Explore the World</div>
									<h2>
										<span>
											@if(app()->getLocale() === 'ar')
												{{$home_items->explore_title_ar}}				
											@elseif(app()->getLocale() === 'ru')
												{{$home_items->explore_title_ru}}
											@else
												{{$home_items->explore_title_en}}
											@endif 
										</span>
									</h2>
									<div class="travilo-text">
										<p>
											@if(app()->getLocale() === 'ar')
												{!!$home_items->explore_description_ar!!}				
											@elseif(app()->getLocale() === 'ru')
												{!!$home_items->explore_description_ru!!}
											@else
												{!!$home_items->explore_description_en!!}
											@endif 
										</p>
									</div>
								</div>
								<div class="facts-two">
									<div class="row clearfix">
										<div class="fact-block col-lg-6 col-md-6 col-sm-6">
											<div class="inner-box clearfix">
												<div class="fact-count">
													<div class="count-box"><span class="count-text" data-stop="{{$total_destinations}}"
															data-speed="1000">0</span>
													</div>
												</div>
												<div class="fact-title">@lang('common.Total') <br>@lang('common.destinations')</div>
											</div>
										</div>
										<div class="fact-block col-lg-6 col-md-6 col-sm-6">
											<div class="inner-box clearfix">
												<div class="fact-count">
													<div class="count-box"><span class="count-text" data-stop="{{$total_Packages}}"
															data-speed="1500">0</span>
													</div>
												</div>
												<div class="fact-title">@lang('common.Total') <br>@lang('common.packages')</div>
											</div>
										</div>
										
									</div>
								</div>
								<div class="link-box">
									<a href="{{ route('about', ['lang' => request()->segment(1), 'cooperator' => $cooperator->slug]) }}" class="theme-btn btn-style-two">
										<span>
											@lang('common.More About Us')
										</span>
									</a>
								</div>
							</div>
						</div>
						<!--Image Col-->
						<div class="image-col col-lg-5 col-md-12 col-sm-12">
							<div class="inner wow fadeInLeft" data-wow-duration="1500ms" data-wow-delay="0ms">
								<div class="d-elem-2"><img src="assets/images/elements/pink-3.png" alt=""></div>
								<div class="image-box">
									<img src="{{asset('uploads/'.$home_items->explore_photo)}}" alt="" title="">
									<a href="{{$home_items->explore_video}}"
										class="lightbox-image vid-btn"><span class="icon fa fa-play"><i
												class="ripple"></i></span></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!--Packages Section-->
		<div class="packages-section">
			<div class="bg-layer" style="background-image: url(assets/images/background/pattern-1.png);"></div>
			<div class="auto-container">
				<div class="title-box">
					<div class="subtitle">Packages</div>
					<h2><span>@lang('common.Travel Packages')</span></h2>
				</div>
				<div class="carousel-box">
					<div class="packages-carousel">
						<!--Block-->
						@foreach ($packages as $item)
							<div class="package-block col-lg-4 col-md-6 col-sm-12">
								<div class="inner-box">
									<!-- Image Section -->
									<div class="image-box">
										<div class="image">
											<a href="{{ route('package', ['lang' => app()->getLocale(), 'cooperator' => $cooperator->slug, 'id' => $item->id]) }}">
												<img src="{{ asset('uploads/'.$item->featured_photo) }}" alt="{{ $item->name_en }}">
											</a>
										</div>
									</div>
									<!-- Details Section -->
									<div class="lower-box ">
										<!-- Location -->
										<div class="location fs-4 text-{{ app()->getLocale() === 'ar' ? 'end' : 'start' }}">
											@if(app()->getLocale() === 'ar')
												{{ $item->destination->name_ar ?? __('common.Unavailable') }}
											@elseif(app()->getLocale() === 'ru')
												{{ $item->destination->name_ru ?? __('common.Unavailable') }}
											@else
												{{ $item->destination->name_en ?? __('common.Unavailable') }}
											@endif
										</div>
					
										<!-- Tour Title and Details -->
										<div class="info clearfix ">
											@if(app()->getLocale() == 'ar')
												<!-- For Arabic: Reverse Order of Package Title and Icon -->
												<div class="persons ">
													<i class="fa-solid fa-user ms-2"></i> 2
												</div>
												<div class="duration ">
													<i class="fa-solid fa-clock ms-2"></i>
													@if(app()->getLocale() === 'ar')
														{{ $item->packageTitle->title_ar ?? __('common.Unavailable') }}
													@elseif(app()->getLocale() === 'ru')
														{{ $item->packageTitle->title_ru ?? __('common.Unavailable') }}
													@else
														{{ $item->packageTitle->title_en ?? __('common.Unavailable') }}
													@endif
												</div>
													
											@else
												<!-- For LTR (English, Russian) -->
												<div class="duration">
													<i class="fa-solid fa-clock me-2"></i>
													@if(app()->getLocale() === 'ar')
														{{ $item->packageTitle->title_ar ?? __('common.Unavailable') }}
													@elseif(app()->getLocale() === 'ru')
														{{ $item->packageTitle->title_ru ?? __('common.Unavailable') }}
													@else
														{{ $item->packageTitle->title_en ?? __('common.Unavailable') }}
													@endif
												</div>
												<div class="persons">
													<i class="fa-solid fa-user me-2"></i> 2
												</div>
											@endif
										</div>
					
										<!-- Ratings and Pricing -->
										<div class="bottom-box clearfix">
											<!-- Rating Section -->
											<div class="rating text-{{ app()->getLocale() === 'ar' ? 'end' : 'start' }}">
												<a href="#" class="theme-btn">
													@if ($item->total_rating && $item->total_rating > 0)
														<i class="fa-solid fa-star"></i>
														<strong> 
															{{ number_format($item->total_score / $item->total_rating, 1) }}
														</strong> &ensp;
														<span class="count">{{ $item->total_rating }} @lang('common.Reviews')</span>
													@else
														<strong>@lang('common.no rating')</strong>
													@endif
												</a>
											</div>
											<!-- Pricing Section -->
											<div class="price text-{{ app()->getLocale() === 'ar' ? 'end' : 'start' }}">
												@lang('common.Start from') &ensp;
												<span class="amount">
													${{ $item->privateTours->filter(fn($tour) => $tour->website)->min('total_price') ?? __('common.N/A') }}
												</span>
											</div>
										</div>
									</div>
								</div>
							</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>

		<!--Why Choose Us-->
		<div class="why-us-two">
			<div class="auto-container">
				<div class="outer-box">
					<div class="bg-grad-left"><img src="{{asset('assets/images/background/bg-gradient-19.png')}}" alt="" title="">
					</div>
					<div class="bg-grad-right"><img src="{{asset('assets/images/background/bg-gradient-20.png')}}" alt="" title="">
					</div>
					<div class="row clearfix">
						<!--Text Col-->
						<div class="text-col col-lg-6 col-md-12 col-sm-12">
							<div class="inner wow fadeInLeft" data-wow-duration="1500ms" data-wow-delay="0ms">
								<div class="d-elem-1"><img src="{{asset('assets/images/elements/purple-3.png')}}" alt=""></div>
								<div class="title-box">
									<div class="subtitle">Why Choose Us</div>
									<h2>
										<span>
											@if(app()->getLocale() === 'ar')
												{{$home_items->choose_title_ar}}				
											@elseif(app()->getLocale() === 'ru')
												{{$home_items->choose_title_ru}}
											@else
												{{$home_items->choose_title_en}}
											@endif 
										</span>
									</h2>
									<p class="travilo-text">
										@if(app()->getLocale() === 'ar')
											{{$home_items->choose_description_ar}}				
										@elseif(app()->getLocale() === 'ru')
											{{$home_items->choose_description_ru}}
										@else
											{{$home_items->choose_description_en}}
										@endif 
									</p>
								</div>
								<div class="features">
									<div class="f-block-three">
										<div class="inner-box">
											<div class="icon"><img src="{{asset('uploads/'.$home_items->choose_icon_1)}}" alt=""></div>
											<h4>
												@if(app()->getLocale() === 'ar')
													{{$home_items->choose_title_1_ar}}				
												@elseif(app()->getLocale() === 'ru')
													{{$home_items->choose_title_1_ru}}
												@else
													{{$home_items->choose_title_1_en}}
												@endif
											</h4>
											<div class="travilo-text">
												@if(app()->getLocale() === 'ar')
													{{$home_items->choose_description_1_ar}}				
												@elseif(app()->getLocale() === 'ru')
													{{$home_items->choose_description_1_ru}}
												@else
													{{$home_items->choose_description_1_en}}
												@endif
											</div>
										</div>
									</div>
									<div class="f-block-three">
										<div class="inner-box">
											<div class="icon"><img src="{{asset('uploads/'.$home_items->choose_icon_2)}}" alt=""></div>
											<h4>
												@if(app()->getLocale() === 'ar')
													{{$home_items->choose_title_2_ar}}				
												@elseif(app()->getLocale() === 'ru')
													{{$home_items->choose_title_2_ru}}
												@else
													{{$home_items->choose_title_2_en}}
												@endif
											</h4>
											<p class="travilo-text">
												@if(app()->getLocale() === 'ar')
													{{$home_items->choose_description_2_ar}}				
												@elseif(app()->getLocale() === 'ru')
													{{$home_items->choose_description_2_ru}}
												@else
													{{$home_items->choose_description_2_en}}
												@endif
											</p>
										</div>
									</div>
									<div class="f-block-three">
										<div class="inner-box">
											<div class="icon"><img src="{{asset('uploads/'.$home_items->choose_icon_3)}}" alt=""></div>
											<h4>
												@if(app()->getLocale() === 'ar')
													{{$home_items->choose_title_3_ar}}				
												@elseif(app()->getLocale() === 'ru')
													{{$home_items->choose_title_3_ru}}
												@else
													{{$home_items->choose_title_3_en}}
												@endif
											</h4>
											<p class="travilo-text">
												@if(app()->getLocale() === 'ar')
													{{$home_items->choose_description_3_ar}}				
												@elseif(app()->getLocale() === 'ru')
													{{$home_items->choose_description_3_ru}}
												@else
													{{$home_items->choose_description_3_en}}
												@endif
											</p>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!--Image Col-->
						<div class="image-col col-lg-6 col-md-12 col-sm-12">
							<div class="inner wow fadeInRight" data-wow-duration="1500ms" data-wow-delay="0ms">
								<div class="d-elem-2"><img src="{{asset('assets/images/elements/yellow-4.png')}}" alt=""></div>
								<div class="image-box">
									<img src="{{asset('uploads/'.$home_items->choose_photo)}}" alt="" title="">
								</div>
								<div class="rating"><span class="icon fa fa-star"></span><span class="count">5,0</span>
								</div>
								<div class="fact-block f-1">
									<div class="inner-box clearfix">
										<div class="fact-count">
											<div class="count-box"><span class="count-text" data-stop="{{$total_users}}"
													data-speed="2000">0</span></div>
										</div>
										<div class="fact-title">@lang('common.Total') <br>@lang('common.Travelers')</div>
									</div>
								</div>
								<div class="fact-block f-2">
									<div class="inner-box clearfix">
										<div class="fact-count">
											<div class="count-box"><span class="count-text" data-stop="{{$total_reviews}}"
													data-speed="2000">0</span></div>
										</div>
										<div class="fact-title">@lang('common.Total')<br>@lang('common.Reviews')</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			{{-- Confused? Get Help --}}
			<div class="get-help wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
				<div class="auto-container">
					<div class="content-box">
						<div class="row clearfix">
							<div class="text-col col-lg-9 col-md-12 col-sm-12">
								<div class="inner">
									<div class="title-box">
										<div class="subtitle">Confused? Get Help</div>
										<h2>
											<span>
												@if(app()->getLocale() === 'ar')
													{{$home_items->help_title_ar}}				
												@elseif(app()->getLocale() === 'ru')
													{{$home_items->help_title_ru}}
												@else
													{{$home_items->help_title_en}}
												@endif
												<i><img src="{{asset('assets/images/elements/white-1.png')}}" alt=""></i>
											</span>
										</h2>
										<p class="travilo-text">
											@if(app()->getLocale() === 'ar')
												{{$home_items->help_description_ar}}				
											@elseif(app()->getLocale() === 'ru')
												{{$home_items->help_description_ru}}
											@else
												{{$home_items->help_description_en}}
											@endif
										</p>
									</div>
								</div>
							</div>
							<div class="link-col col-lg-3 col-md-12 col-sm-12">
								<div class="inner">
									<div class="link-box"><a href="{{ route('contact', ['lang' => request()->segment(1), 'cooperator' => $cooperator->slug]) }}" class="theme-btn btn-style-two">
										<span>@lang('common.Contact Us')</span></a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>

		<!--Reviews-->
		<div class="testimonials-two">
			<div class="auto-container">
				<div class="row clearfix">
					<!--Text Col-->
					<div class="text-col col-lg-6 col-md-12 col-sm-12">
						<div class="inner wow fadeInRight" data-wow-duration="1500ms" data-wow-delay="0ms">
							<div class="title-box">
								<div class="subtitle">Testimonials</div>
								<h2><span>@lang('common.What Travelers Say')</span></h2>
							</div>
							<div class="carousel-box">
								<div class="testi-slider-two">
									<!--Block-->
									@foreach ($reviews as $item)
										<div class="testi-block-two">
											<div class="inner-box">
												<div class="quote-icon"><span class="flaticon-left-quote"></span></div>
												<div class="rating">
													<div class="stars">
														@for ($i = 1; $i <= 5; $i++)
															@if ($i<= $item->rating)
																<i class="fa-solid fa-star"></i>
															@endif
														@endfor
													</div>
												</div>
												<p class="travilo-text">
													{{$item->comment}}
												</p>
												<div class="info">
													<div class="image">
														@if ($item->user->photo == '')
															<img src="{{asset('uploads/default.png')}}" alt=""> 
														@else
															<img src="{{asset('uploads/'.$item->user->photo)}}" alt=""> 
														@endif
													</div>
													<div class="name">{{$item->user->name}}</div>
													<div class="designation">{{ $item->created_at->format('F j, Y') }}</div>
												</div>
											</div>
										</div>
									@endforeach
								</div>
							</div>
						</div>
					</div>
					<!--Image Col-->
					<div class="image-col col-lg-6 col-md-12 col-sm-12">
						<div class="inner wow fadeInLeft" data-wow-duration="1500ms" data-wow-delay="0ms">
							<div class="image-box"><img src="{{asset('uploads/'.$home_items->testimonial_photo)}}" alt=""
									title="">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!--our partner Logos-->
		<div class="partners-two alternate">
			<div class="auto-container">
				<div class="carousel-box">
					<div class="partners-carousel">
						@foreach ($partners as $item)
							<!--Block-->
							<div class="partner-block">
								<div class="image"><a href="#"><img src="{{asset('uploads/'.$item->logo)}}" alt=""></a>
							</div>
						</div>
						@endforeach
					</div>
				</div>

			</div>
		</div>

		<!--Latest Posts-->
		<div class="news-two">
			<div class="auto-container">
				<div class="title-box centered">
					<div class="subtitle">Blog</div>
					<h2><span>@lang('common.Latest Posts')</span></h2>
				</div>
				<div class="news-box">
					<div class="bg-grad-left"><img src="assets/images/background/bg-gradient-21.png" alt="" title="">
					</div>
					<div class="bg-grad-right"><img src="assets/images/background/bg-gradient-22.png" alt="" title="">
					</div>
					<div class="row clearfix">

						@foreach ($posts as $item)
							<div class="news-block-two col-lg-4 col-md-6 col-sm-12 wow fadeInUp" data-wow-duration="1500ms"
								data-wow-delay="0ms">
								<div class="inner-box">
									<div class="image-box"><a href="{{ route('post', ['lang' => app()->getLocale(), 'cooperator' => $cooperator->slug, 'slug' => $item->slug]) }}"><img
												src="{{asset('uploads/'.$item->photo)}}" alt=""></a></div>
									<div class="lower-box">
										<ul class="info clearfix {{ app()->getLocale() === 'ar' ? 'text-end' : 'text-start' }}">
											<li>
												<a href="{{ route('post', ['lang' => app()->getLocale(), 'cooperator' => $cooperator->slug, 'slug' => $item->slug]) }}">
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
											<a href="{{ route('post', ['lang' => app()->getLocale(), 'cooperator' => $cooperator->slug, 'slug' => $item->slug]) }}">
												@if(app()->getLocale() === 'ar')
													{{$item->title_ar}}
												@elseif(app()->getLocale() === 'ru')
													{{$item->title_ru}}
												@else
													{{$item->title_en}}
												@endif
											</a>
										</h3>
									</div>
								</div>
							</div>
						@endforeach
			
					</div>
				</div>
			</div>
		</div>

		

		
       
@endsection