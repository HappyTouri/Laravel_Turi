
@extends('website.layout.master')

@section('main_content')


		<!-- Banner Section -->
		<section class="inner-banner">
			<div class="image-layer" style="background-image: url({{asset('uploads/'.$destination->banner)}});">
			</div>
			<div class="auto-container">
				<div class="content-box">
					<h1>
                        @if(app()->getLocale() === 'ar')
                            {{$destination->name_ar}}
						@elseif(app()->getLocale() === 'ru')
                            {{$destination->name_ru}}
						@else
                            {{$destination->name_en}}
						@endif
                    </h1>
					<div class="bread-crumb">
						<ul class="clearfix">
							<li><a href="{{ route('home.lang', ['lang' => request()->segment(1), 'cooperator' => $cooperator->slug]) }}">@lang('common.home')</a></li>
							<li><a href="{{ route('destinations', ['lang' => app()->getLocale(), 'cooperator' => request()->segment(2)]) }}">@lang('common.destinations')</a></li>
							<li class="current">
								@if(app()->getLocale() === 'ar')
									{{$destination->name_ar}}
								@elseif(app()->getLocale() === 'ru')
									{{$destination->name_ru}}
								@else
									{{$destination->name_en}}
								@endif
							</li>
						</ul>
					</div>
				</div>
			</div>
		</section>
		<!--End Banner Section -->

		<!--Destination Single-->
		<div class="destination-single">
			<div class="auto-container">
				{{-- <div class="upper-images">
					<div class="row clearfix">
						<!--Image Block-->
						<div class="image-col col-lg-8 col-md-12 col-sm-12">
							<!--Image Block-->
							<div class="image-block">
								<div class="image"><a href="assets/images/resources/destinations/istanbul-masjid.jpg"
										class="lightbox-image" data-fancybox="D-Gallery"><img
											src="assets/images/resources/destinations/istanbul-masjid-thumb.jpg"
											alt="Istanbul Masjid"></a>
								</div>
							</div>
						</div>

						<!--Image Block-->
						<div class="image-col col-lg-4 col-md-12 col-sm-12">
							<!--Image Block-->
							<div class="image-block">
								<div class="image"><a href="assets/images/resources/destinations/istanbul-city.jpg"
										class="lightbox-image" data-fancybox="D-Gallery"><img
											src="assets/images/resources/destinations/istanbul-city-thumb.jpg"
											alt="Istanbul City"></a>
								</div>
							</div>

							<!--Image Block-->
							<div class="image-block">
								<div class="image"><a
										href="assets/images/resources/destinations/istanbul-lighthouse.jpg"
										class="lightbox-image" data-fancybox="D-Gallery"><img
											src="assets/images/resources/destinations/istanbul-lighthouse-thumb.jpg"
											alt="Light House"></a>
								</div>
								<div class="img-link"><a href="#" class="theme-btn"><span>+ 160 Photos</span></a></div>
							</div>
						</div>


					</div>
				</div> --}}
				<div class="lower-content">
					<div class="row clearfix">
						<div class="content-col col-lg-8 col-md-12 col-sm-12">
							<div class="inner" 
								@if(app()->getLocale() === 'ar') dir="rtl" @endif>
								<h3 class="@if(app()->getLocale() === 'ar') 'text-end' @else text-start @endif">
									<span>
										@lang('common.About Istanbul')
									</span>
									<span>
										@if(app()->getLocale() === 'ar')
											{{$destination->name_ar}}
										@elseif(app()->getLocale() === 'ru')
											{{$destination->name_ru}}
										@else
											{{$destination->name_en}}
										@endif
									</span>
									
								</h3>
								<div class="travilo-text">
									<p>
										@if(app()->getLocale() === 'ar')
											{!! $destination->description_ar !!}
										@elseif(app()->getLocale() === 'ru')
											{!! $destination->description_ru !!}
										@else
											{!! $destination->description_en !!}
										@endif
									</p>
								</div>

								<h3 class="@if(app()->getLocale() === 'ar') 'text-end' @else text-start @endif">
									@lang('common.Activities')
								</h3>
								<div class="travilo-text">
									<p>
										@if(app()->getLocale() === 'ar')
											{!! $destination->activities_ar !!}
										@elseif(app()->getLocale() === 'ru')
											{!! $destination->activities_ru !!}
										@else
											{!! $destination->activities_en !!}
										@endif
									</p>
								</div>

								<h3 class="@if(app()->getLocale() === 'ar') 'text-end' @else text-start @endif">
									@lang('common.Visa Requirement')
								</h3>
								<div class="travilo-text">
									<p>
										@if(app()->getLocale() === 'ar')
											{!! $destination->visa_requirement_ar !!}
										@elseif(app()->getLocale() === 'ru')
											{!! $destination->visa_requirement_ru !!}
										@else
											{!! $destination->visa_requirement_en !!}
										@endif
									</p>
								</div>

								<h3 class="@if(app()->getLocale() === 'ar') 'text-end' @else text-start @endif">
									@lang('common.Best Time to Visit')
								</h3>
								<div class="travilo-text">
									<p>
										@if(app()->getLocale() === 'ar')
											{!! $destination->best_time_ar !!}
										@elseif(app()->getLocale() === 'ru')
											{!! $destination->best_time_ru !!}
										@else
											{!! $destination->best_time_en !!}
										@endif
									</p>
								</div>

								{{-- Photo Gallery --}}
								@if (count($destination_photos) > 0)
									<div class="t-gallery">
										<h3 class="@if(app()->getLocale() === 'ar') 'text-end' @else text-start @endif">
											@lang('common.Photo Gallery')
										</h3>
										<div class="row g-3"> <!-- Bootstrap grid with gap -->
											@foreach ($destination_photos as $item)
												<div class="col-md-3 col-4">
													<div class="image">
														<a href="{{ asset('uploads/' . $item->photo) }}" 
														class="lightbox-image" data-fancybox="SbGallery">
															<img src="{{ asset('uploads/' . $item->photo) }}" class="img-fluid rounded" alt="Photo">
														</a>
													</div>
												</div>
											@endforeach
										</div>
									</div>
								@endif

								{{-- Video Gallery --}}
								@if (count($destination_videos) > 0)
									<div class="t-gallery">
										<h3 class="@if(app()->getLocale() === 'ar') 'text-end' @else text-start @endif">
											@lang('common.Video Gallery')
										</h3>
										<div class="row">
											@foreach ($destination_videos as $item)
												<div class="col-md-4 col-12 mb-4">
													<div class="video-box wow fadeInUp position-relative">
														<div class="image-box">
															<img src="http://img.youtube.com/vi/{{$item->video}}/0.jpg" alt="Video Thumbnail" class="img-fluid rounded">
															<a href="http://www.youtube.com/watch?v={{$item->video}}" 
															class="lightbox-image vid-btn d-flex align-items-center justify-content-center position-absolute top-50 start-50 translate-middle bg-danger text-white rounded-circle"
															style="width: 60px; height: 60px; font-size: 24px;">
																<span class="icon fa fa-play"></span>
															</a>
														</div>
													</div>
												</div>
											@endforeach
										</div>
									</div>
								@endif
							</div>

						</div>
						<div class="info-col col-lg-4 col-md-12 col-sm-12">
							<div class="inner">
								<!--Block-->
								<div class="info-block loc-map" 
									@if(app()->getLocale() === 'ar') dir="rtl" @endif>
									<div class="inner-box">
										<h3 class="@if(app()->getLocale() === 'ar') 'text-end' @else text-start @endif">
											@lang('common.City Map')
										</h3>
										<div class="map-box">
											<iframe
												src="{{$destination->map}}"
												allowfullscreen="" loading="lazy"
												referrerpolicy="no-referrer-when-downgrade"></iframe>
										</div>
									</div>
								</div>

								<!--Block-->
								<div class="info-block weather-info" 
									@if(app()->getLocale() === 'ar') dir="rtl" @endif>
									<div class="inner-box">
										<h3 class="@if(app()->getLocale() === 'ar') 'text-end' @else text-start @endif">
											@lang('common.Basic Information')
										</h3>
										<div class="weather">
											<ul>
												<li class="clearfix">
													@if(app()->getLocale() === 'ar')
														<span class="dtl">
															{{$destination->language_ar}}
														</span>
														<span class="ttl float-end text-end">
															@lang('common.Language')
														</span>
													@else
														<span class="ttl float-start text-start">
															@lang('common.Language')
														</span>
														<span class="dtl">
															@if(app()->getLocale() === 'ru')
																{{$destination->language_ru}}
															@else
																{{$destination->language_en}}
															@endif
														</span>
													@endif
												</li>
												<li class="clearfix">
													@if(app()->getLocale() === 'ar')
														<span class="dtl">
															{{$destination->currency_ar}}
														</span>
														<span class="ttl float-end text-end">
															@lang('common.Currency')
														</span>
													@else
														<span class="ttl float-start text-start">
															@lang('common.Currency')
														</span>
														<span class="dtl">
															@if(app()->getLocale() === 'ru')
																{{$destination->currency_ru}}
															@else
																{{$destination->currency_en}}
															@endif
														</span>
													@endif
												</li>
												<li class="clearfix">
													@if(app()->getLocale() === 'ar')
														<span class="dtl">
															{{$destination->area_ar}}
														</span>
														<span class="ttl float-end text-end">
															@lang('common.Area')
														</span>
													@else
														<span class="ttl float-start text-start">
															@lang('common.Area')
														</span>
														<span class="dtl">
															@if(app()->getLocale() === 'ru')
																{{$destination->area_ru}}
															@else
																{{$destination->area_en}}
															@endif
														</span>
													@endif
												</li>
												<li class="clearfix">
													@if(app()->getLocale() === 'ar')
														<span class="dtl">
															{{$destination->timezone_ar}}
														</span>
														<span class="ttl float-end text-end">
															@lang('common.Timezone')
														</span>
													@else
														<span class="ttl float-start text-start">
															@lang('common.Timezone')
														</span>
														<span class="dtl">
															@if(app()->getLocale() === 'ru')
																{{$destination->timezone_ru}}
															@else
																{{$destination->timezone_en}}
															@endif
														</span>
													@endif
												</li>
											</ul>
										</div>
									</div>
								</div>


							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!--Posts Section-->
		<div class="default-post-section">
			<div class="auto-container">
				<div class="u-title clearfix">
					<h2>
						 @lang('common.Tours in')
						@if(app()->getLocale() === 'ar')
							{{$destination->name_ar}}
						@elseif(app()->getLocale() === 'ru')
							{{$destination->name_ru}}
						@else
							{{$destination->name_en}}
						@endif
				</h2>
					<div class="link-box"><a href="#" class="theme-btn">View All</a></div>
				</div>
				<div class="row clearfix justify-content-center">
					<!--Block-->
					@foreach ($packages as $item)
						<div class="package-block col-lg-4 col-md-6 col-sm-12">
							<div class="inner-box">
								<div class="image-box">
									<div class="image"><a href="{{ route('package', ['lang' => app()->getLocale(), 'cooperator' => request()->segment(2), 'id' => $item->id]) }}"><img
												src="{{asset('uploads/'.$item->featured_photo)}}"
												alt="{{$item->name_en}}"></a>
									</div>
								</div>
								<div class="lower-box">
									<div class="p-icon"><img src="assets/images/icons/t-icon-1.png" alt=""><span
											class="icon flaticon-adventure"></span></div>
									<div class="location fs-4">
										@if(app()->getLocale() === 'ar')
											{{$item->destination->name_ar}}
										@elseif(app()->getLocale() === 'ru')
											{{$item->destination->name_ru}}
										@else
											{{$item->destination->name_en}}
										@endif
									</div>
									{{-- <h5>
										<a href="tour-single.html">
											@if(app()->getLocale() === 'ar')
												{{$item->packageTitle->title_ar}}
											@elseif(app()->getLocale() === 'ru')
												{{$item->packageTitle->title_ru}}
											@else
												{{$item->packageTitle->title_en}}
											@endif
										</a>
									</h5> --}}
									<div class="info clearfix">
										<div class="duration">
											<i class="fa-solid fa-clock"></i> 
											@if(app()->getLocale() === 'ar')
												{{$item->packageTitle->title_ar}}
											@elseif(app()->getLocale() === 'ru')
												{{$item->packageTitle->title_ru}}
											@else
												{{$item->packageTitle->title_en}}
											@endif
										</div>
										<div class="persons"><i class="fa-solid fa-user"></i> 2</div>
									</div>
									<div class="bottom-box clearfix">
										<div class="rating"><a href="#" class="theme-btn"><i
													class="fa-solid fa-star"></i>
												<strong>
													@if ($item->total_rating && $item->total_rating > 0)
														{{number_format($item->total_score / $item->total_rating, 1)}}
													@else
													no rating 
													@endif
													
												</strong> &ensp; 
												<span class="count">
													{{$item->total_rating}} Reviews
												</span></a>
										</div>
										<div class="price">Start from &ensp;<span class="amount">$399</span></div>
									</div>
								</div>
							</div>
						</div>
					@endforeach

					

				</div>
			</div>
		</div>

		


@endsection