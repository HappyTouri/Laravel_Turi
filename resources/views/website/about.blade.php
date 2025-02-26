@extends('website.layout.master')

@section('main_content')

		<!-- Banner Section -->
		<div class="inner-banner">
			<div class="image-layer" style="background-image: url({{asset('uploads/'.$about_banner)}});">
			</div>
			<div class="auto-container">
				<div class="content-box">
					<h1>@lang('common.About Us')</h1>
					<div class="bread-crumb">
						<ul class="clearfix">
							<li><a href="{{ route('home.lang', ['lang' => request()->segment(1), 'cooperator' => $cooperator->slug]) }}">@lang('common.home')</a></li>
							<li class="current">@lang('common.About Us')</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<!--End Banner Section -->


		<!--About Us Section-->
		<div class="about-section alternate">
			<div class="bg-grad-right">
				<img src="{{asset('assets/images/background/bg-gradient-2.png')}}" alt="" title="">
			</div>
			<div class="auto-container">
				<div class="row clearfix">
					<!--Text Col-->
					<div class="text-col col-lg-6 col-md-12 col-sm-12">
						<div class="inner wow fadeInRight" data-wow-duration="1500ms" data-wow-delay="0ms">
							<div class="d-elem-1"><img src="{{asset('assets/images/elements/green-1.png')}}" alt=""></div>
							<div class="title-box">
								<div class="subtitle">Let’s Explore the World</div>
								<h2><span class="">
									@if(app()->getLocale() === 'ar')
										{{$about_item->top_title_ar}}
									@elseif(app()->getLocale() === 'ru')
										{{$about_item->top_title_ru}}
									@else
										{{$about_item->top_title_en}}
									@endif
								</span></h2>
								<p class="travilo-text">
									@if(app()->getLocale() === 'ar')
										{!!$about_item->top_description_ar!!}
									@elseif(app()->getLocale() === 'ru')
										{!!$about_item->top_description_ru!!}
									@else
										{!!$about_item->top_description_en!!}
									@endif
								</p>
							</div>
							<div class="features">
								<div class="row clearfix">
									<div class="f-block col-lg-6 col-md-6 col-sm-12">
										<div class="inner-box">
											<div class="icon"><img src="{{asset('uploads/'.$about_item->top_logo_1)}}" alt=""></div>
											<h6>
												@if(app()->getLocale() === 'ar')
													{{$about_item->logo1_title_ar}}
												@elseif(app()->getLocale() === 'ru')
													{{$about_item->logo1_title_ru}}
												@else
													{{$about_item->logo1_title_en}}
												@endif
											</h6>
										</div>
									</div>
									<div class="f-block col-lg-6 col-md-6 col-sm-12">
										<div class="inner-box">
											<div class="icon"><img src="{{asset('uploads/'.$about_item->top_logo_2)}}" alt=""></div>
											<h6>
												@if(app()->getLocale() === 'ar')
													{{$about_item->logo2_title_ar}}
												@elseif(app()->getLocale() === 'ru')
													{{$about_item->logo2_title_ru}}
												@else
													{{$about_item->logo2_title_en}}
												@endif
											</h6>
										</div>
									</div>
								</div>
							</div>
							<div class="lower-text">
								<div class="travilo-text">
									<ul>
										<li>
											@if(app()->getLocale() === 'ar')
												{{$about_item->point_1_ar}}
											@elseif(app()->getLocale() === 'ru')
												{{$about_item->point_1_ru}}
											@else
												{{$about_item->point_1_en}}
											@endif
										</li>
										<li>
											@if(app()->getLocale() === 'ar')
												{{$about_item->point_2_ar}}
											@elseif(app()->getLocale() === 'ru')
												{{$about_item->point_2_ru}}
											@else
												{{$about_item->point_2_en}}
											@endif
										</li>
										<li>
											@if(app()->getLocale() === 'ar')
												{{$about_item->point_3_ar}}
											@elseif(app()->getLocale() === 'ru')
												{{$about_item->point_3_ru}}
											@else
												{{$about_item->point_3_en}}
											@endif
										</li>
									</ul>
								</div>
								<div class="link-box">
									<a href="about.html" class="theme-btn btn-style-one">
										<span>
											@lang('common.Read More')
										</span>
									</a>
								</div>
							</div>
						</div>
					</div>
					<!--Image Col-->
					<div class="image-col col-lg-6 col-md-12 col-sm-12">
						<div class="inner wow fadeInLeft" data-wow-duration="1500ms" data-wow-delay="0ms">
							<div class="bg-grad-left">
								<img src="{{asset('assets/images/background/bg-gradient-26.png')}}" alt="" title="">
							</div>
							<div class="d-elem-1"><img src="{{asset('assets/images/elements/yellow-3.png')}}" alt=""></div>
							<div class="d-elem-2"><img src="{{asset('assets/images/elements/pink-4.png')}}" alt=""></div>
							<div class="image-box clearfix">
								<div class="image">
									<img src="{{asset('uploads/'.$about_item->image_2)}}" alt="Tickets"
										title="Tickets">
								</div>
								<div class="image">
									<img src="{{asset('uploads/'.$about_item->image_1)}}" alt=""
										title="">
								</div>
							</div>
							<div class="exp"><span class="count">12</span> Successful <br>Years</div>
						</div>
					</div>
				</div>
			</div>
		</div>


		<!--Intro Section-->
		<div class="intro-two">
			<div class="auto-container">
				<div class="row clearfix text-center">
                    <!--Block-->
                    <div class="intro-block-two col-lg-4 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="0ms"
                        data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="icon mb-3">
                                <span>
                                    <img src="{{asset('uploads/'.$about_item->mission_logo)}}" alt="" style="display: block; margin: 0 auto;">
                                </span>
                            </div>
                            <h4 style="margin-bottom: 10px;">@lang('common.Our Mission')</h4>
                            <div class="travilo-text">
								@if(app()->getLocale() === 'ar')
									{!!$about_item->mission_description_ar!!}
								@elseif(app()->getLocale() === 'ru')
									{!!$about_item->mission_description_ru!!}
								@else
									{!!$about_item->mission_description_en!!}
								@endif
                            </div>
                        </div>
                    </div>
                    <!--Block-->
                    <div class="intro-block-two col-lg-4 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="300ms"
                        data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="icon mb-3">
                                <span>
                                    <img src="{{asset('uploads/'.$about_item->destination_logo)}}" alt="" style="display: block; margin: 0 auto;">
                                </span>
                            </div>
                            <h4 style="margin-bottom: 10px;">@lang('common.Destination Insights')</h4>
                            <div class="travilo-text">
								@if(app()->getLocale() === 'ar')
									{!!$about_item->destination_description_ar!!}
								@elseif(app()->getLocale() === 'ru')
									{!!$about_item->destination_description_ru!!}
								@else
									{!!$about_item->destination_description_en!!}
								@endif
                            </div>
                        </div>
                    </div>
                    <!--Block-->
                    <div class="intro-block-two col-lg-4 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="600ms"
                        data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="icon mb-3">
                                <span>
                                    <img src="{{asset('uploads/'.$about_item->planning_logo)}}" alt="" style="display: block; margin: 0 auto;">
                                </span>
                            </div>
                            <h4 style="margin-bottom: 10px;">@lang('common.Tailored Travel Planning')</h4>
                            <div class="travilo-text">
								@if(app()->getLocale() === 'ar')
									{!!$about_item->planning_description_ar!!}
								@elseif(app()->getLocale() === 'ru')
									{!!$about_item->planning_description_ru!!}
								@else
									{!!$about_item->planning_description_en!!}
								@endif
                            </div>
                        </div>
                    </div>
                </div>
                
			</div>
		</div>

		<!--Our Speciality Section-->
		<div class="our-speciality">
			<div class="auto-container">
				<div class="outer-box">
					<div class="bg-grad-left"><img src="assets/images/background/bg-gradient-23.png" alt="" title="">
					</div>
					<div class="row clearfix">
						<!--Text Col-->
						<div class="title-col col-lg-5 col-md-12 col-sm-12">
							<div class="inner wow fadeInLeft" data-wow-duration="1500ms" data-wow-delay="0ms">
								<div class="d-elem-1"><img src="assets/images/elements/green-4.png" alt=""></div>
								<div class="title-box">
									<div class="subtitle">Our Speciality</div>
									<h2><span>
										@if(app()->getLocale() === 'ar')
											{{$about_item->main_title_ar}}
										@elseif(app()->getLocale() === 'ru')
											{{$about_item->main_title_ru}}
										@else
											{{$about_item->main_title_en}}
										@endif
									</span></h2>
									<p class="travilo-text">
										@if(app()->getLocale() === 'ar')
											{!!$about_item->main_description_ar!!}
										@elseif(app()->getLocale() === 'ru')
											{!!$about_item->main_description_ru!!}
										@else
											{!!$about_item->main_description_en!!}
										@endif
									</p>
								</div>
							</div>
						</div>
						<!--Content Col-->
						<div class="content-col col-lg-7 col-md-12 col-sm-12">
							<div class="inner wow fadeInRight" data-wow-duration="1500ms" data-wow-delay="0ms">
								<div class="features">
									<div class="row clearfix">
										<div class="feature col-lg-6 col-md-6 col-sm-12">
											<div class="inner-box">
												<div class="icon"><img src="assets/images/icons/f-icon-10.png" alt="">
												</div>
												<h4>
													@if(app()->getLocale() === 'ar')
														{{$about_item->title_1_ar}}
													@elseif(app()->getLocale() === 'ru')
														{{$about_item->title_1_ru}}
													@else
														{{$about_item->title_1_en}}
													@endif
												</h4>
												<div class="travilo-text">
													@if(app()->getLocale() === 'ar')
														{!!$about_item->description_1_ar!!}
													@elseif(app()->getLocale() === 'ru')
														{!!$about_item->description_1_ru!!}
													@else
														{!!$about_item->description_1_en!!}
													@endif
												</div>
											</div>
										</div>
										<div class="feature col-lg-6 col-md-6 col-sm-12">
											<div class="inner-box">
												<div class="icon"><img src="assets/images/icons/f-icon-11.png" alt="">
												</div>
												<h4>
													@if(app()->getLocale() === 'ar')
														{{$about_item->title_2_ar}}
													@elseif(app()->getLocale() === 'ru')
														{{$about_item->title_2_ru}}
													@else
														{{$about_item->title_2_en}}
													@endif
												</h4>
												<div class="travilo-text">
													@if(app()->getLocale() === 'ar')
														{!!$about_item->description_2_ar!!}
													@elseif(app()->getLocale() === 'ru')
														{!!$about_item->description_2_ru!!}
													@else
														{!!$about_item->description_2_en!!}
													@endif
												</div>
											</div>
										</div>
										<div class="feature col-lg-6 col-md-6 col-sm-12">
											<div class="inner-box">
												<div class="icon"><img src="assets/images/icons/f-icon-12.png" alt="">
												</div>
												<h4>
													@if(app()->getLocale() === 'ar')
														{{$about_item->title_3_ar}}
													@elseif(app()->getLocale() === 'ru')
														{{$about_item->title_3_ru}}
													@else
														{{$about_item->title_3_en}}
													@endif
												</h4>
												<div class="travilo-text">
													@if(app()->getLocale() === 'ar')
														{!!$about_item->description_3_ar!!}
													@elseif(app()->getLocale() === 'ru')
														{!!$about_item->description_3_ru!!}
													@else
														{!!$about_item->description_3_en!!}
													@endif
												</div>
											</div>
										</div>
										<div class="feature col-lg-6 col-md-6 col-sm-12">
											<div class="inner-box">
												<div class="icon"><img src="assets/images/icons/f-icon-13.png" alt="">
												</div>
												<h4>
													@if(app()->getLocale() === 'ar')
														{{$about_item->title_4_ar}}
													@elseif(app()->getLocale() === 'ru')
														{{$about_item->title_4_ru}}
													@else
														{{$about_item->title_4_en}}
													@endif
												</h4>
												<div class="travilo-text">
													@if(app()->getLocale() === 'ar')
														{!!$about_item->description_4_ar!!}
													@elseif(app()->getLocale() === 'ru')
														{!!$about_item->description_4_ru!!}
													@else
														{!!$about_item->description_4_en!!}
													@endif
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!--Facts Section-->
		<div class="facts-section alt-padding">
			<div class="auto-container">
				<div class="fact-counter">
					<div class="row clearfix">
						<div class="fact-block col-lg-3 col-md-6 col-sm-12">
							<div class="inner clearfix">
								<div class="fact-count">
									<div class="count-box"><span class="count-text" data-stop="{{$total_destinations}}"
											data-speed="2000">0</span><i>+</i>
									</div>
								</div>
								<div class="fact-title">@lang('common.Total') <br>@lang('common.destinations')</div>
							</div>
						</div>
						<div class="fact-block col-lg-3 col-md-6 col-sm-12">
							<div class="inner clearfix">
								<div class="fact-count">
									<div class="count-box"><span class="count-text" data-stop="{{$total_Packages}}"
											data-speed="3000">0</span><i>+</i>
									</div>
								</div>
								<div class="fact-title">@lang('common.Total') <br>@lang('common.packages')</div>
							</div>
						</div>
						<div class="fact-block col-lg-3 col-md-6 col-sm-12">
							<div class="inner clearfix">
								<div class="fact-count">
									<div class="count-box"><span class="count-text" data-stop="{{$total_users}}"
											data-speed="2000">0</span><i>+</i>
									</div>
								</div>
								<div class="fact-title">@lang('common.Total') <br>@lang('common.Travelers')</div>
							</div>
						</div>
						<div class="fact-block col-lg-3 col-md-6 col-sm-12">
							<div class="inner clearfix">
								<div class="fact-count">
									<div class="count-box"><span class="count-text" data-stop="{{$total_reviews}}"
											data-speed="2000">0</span><i>+</i>
									</div>
								</div>
								<div class="fact-title">@lang('common.Total') <br>@lang('common.Reviews')</div>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>

		<!--Team Section-->
		<!--Team Section-->
		<div class="team-section">
			<div class="auto-container">
				<div class="title-box centered wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
					<div class="subtitle">Team Members</div>
					<h2><span>@lang('common.Our Amazing Team Players')</span></h2>
				</div>

				<div class="team-box wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
					<div class="bg-grad-left"><img src="assets/images/background/bg-gradient-24.png" alt="" title=""></div>
					<div class="bg-grad-right"><img src="assets/images/background/bg-gradient-25.png" alt="" title=""></div>
					<div class="d-elem-1"><img src="assets/images/elements/purple-4.png" alt=""></div>

					<div class="carousel-box">
						<div class="partners-carousel">
							@foreach ($team_members as $item)
							<div class="team-block p-md-2">
								<div class="inner-box clearfix">
									<div class="image-box">
										<div class="image">
											<a href="#"><img src="{{ asset('uploads/'.$item->photo) }}" alt="Team"></a>
										</div>
										<ul class="social-links clearfix">
											@if($item->facebook)
												<li><a href="{{ $item->facebook }}" class="facebook"><i class="fab fa-facebook-f"></i></a></li>
											@endif
										
											@if($item->instagram)
												<li><a href="{{ $item->instagram }}" class="youtube"><i class="fab fa-instagram"></i></a></li>
											@endif
										
											@if($item->twitter)
												<li><a href="{{ $item->twitter }}" class="twitter"><i class="fab fa-twitter"></i></a></li>
											@endif
										
											@if($item->linkedin)
												<li><a href="{{ $item->linkedin }}" class="linkedin"><i class="fab fa-linkedin-in"></i></a></li>
											@endif
										
											@if($item->youtube)
												<li><a href="{{ $item->youtube }}" class="youtube"><i class="fab fa-youtube"></i></a></li>
											@endif
										</ul>
										
									</div>
									<h4><a href="#">{{ $item->name }}</a></h4>
									<div class="designation">{{$item->rule->rule}}</div>
								</div>
							</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>


		<!--Testimonials Section-->
		<div class="testimonials-section alt-bg">
			<div class="auto-container">
				<div class="title-box centered wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
					<div class="subtitle">Testimonials</div>
					<h2><span>@lang('common.What Travelers Say')</span></h2>
				</div>

				<div class="carousel-box wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
					<div class="testimonial-carousel">

						<!--Block-->
						@foreach ($reviews as $item)
							<div class="testi-block-one">
								<div class="inner-box">
									<div class="icon"><span class="flaticon-left-quote"></span></div>
									<div class="travilo-text">
										{{$item->comment}}
									</div>
									<div class="info">
										<div class="image">
											@if ($item->user->photo == '')
												<img src="{{asset('uploads/default.png')}}" alt=""> 
											@else
												<img src="{{asset('uploads/'.$item->user->photo)}}" alt=""> 
											@endif
										</div>
										<div class="rating">
											<div class="stars">
												@for ($i = 1; $i <= 5; $i++)
													@if ($i<= $item->rating)
														<i class="fa-solid fa-star"></i>
													@endif
												@endfor
											</div>
										</div>
										<div class="name">{{$item->user->name}}</div>
										<div class="designation">
											@if(app()->getLocale() === 'ar')
												{{$item->package->packageTitle->title_ar}}
											@elseif(app()->getLocale() === 'ru')
												{{$item->package->packageTitle->title_ru}}
											@else
												{{$item->package->packageTitle->title_en}}
											@endif
										</div>
									</div>
								</div>
							</div>
						@endforeach
					</div>
				</div>

			</div>
		</div>

		<!--Partners Section-->
		<div class="partners-two">
			<div class="auto-container">
				<div class="title-box centered">
					<div class="subtitle">Valuable Partners</div>
					<h2>@lang('common.Our Valuable Partners')</h2>
				</div>
				<div class="carousel-box">
					<div class="partners-carousel">
						<!--Block-->
						@foreach ($partners as $item)
							<div class="partner-block">
								<div class="image"><a href="#"><img src="{{asset('uploads/'.$item->logo)}}" alt=""></a>
								</div>
							</div>
						@endforeach
					</div>
				</div>

			</div>
		</div>



@endsection