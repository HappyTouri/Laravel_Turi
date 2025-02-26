
@extends('website.layout.master')

@section('main_content')

		<!-- Banner Section -->
		<div class="tour-single-banner   ">
			<div class="image-layer" style="background-image: url({{asset('uploads/'.$private_tour->package->banner)}});">
			</div>
			<div class="auto-container">
				<div class="content-box">
					<div class="content clearfix">
						<div class="t-type">
							<div class="icon"><img src="assets/images/icons/t-icon-1.png" alt=""></div>
							
						</div>
						
					</div>
				</div>
			</div>
		</div>
		<!--End Banner Section -->

		<!--Default Single Container-->
		<div class="dsp-container tour-single">
			<div class="auto-container">
				<div class="row clearfix">

					<!--Content Side-->
					<div class="content-side col-xl-8 col-lg-12 col-md-12 col-sm-12 ">
						<div class="content-inner ">

							<div class="sp-header  " dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
								<div class="loc-rat clearfix {{ app()->getLocale() === 'ar' ? 'text-end ms-3' : 'text-start me-3' }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
									<!-- Destination Name -->
									<h1 class="{{ app()->getLocale() === 'ar' ? 'text-end' : 'text-start' }}">
										@if(app()->getLocale() === 'ar')
											{{$private_tour->package->destination->name_ar}}
										@elseif(app()->getLocale() === 'ru')
											{{$private_tour->package->destination->name_ru}}
										@else
											{{$private_tour->package->destination->name_en}}
										@endif
									</h1>
									
									<!-- Rating -->
									@if ($package_rating)
									
										<a href="#" class="theme-btn d-flex align-items-center  ">
											<i class="fa-solid fa-star {{ app()->getLocale() === 'ar' ? 'ms-2' : 'me-2' }}"></i>
											<strong>{{$package_rating}}</strong>
											<span class="count  {{ app()->getLocale() === 'ar' ? 'me-2' : 'ms-2' }}">{{$total_reviews}} Reviews</span>
										</a>
									
									@endif
								
									<!-- Add Favorite Placeholder -->
									<div class="add-fav"></div>
								</div>
								
								
								
							
								<!-- Title -->
								<h3 class="{{ app()->getLocale() === 'ar' ? 'text-end' : 'text-start' }}">
									@if(app()->getLocale() === 'ar')
										{{$private_tour->tourTitle->title_ar}} 
									@elseif(app()->getLocale() === 'ru')
										{{$private_tour->tourTitle->title_ru}}
									@else
										{{$private_tour->tourTitle->title_en}}
									@endif
								</h3>
							
								<!-- Info Section -->
								<div class="info clearfix  d-flex {{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
									<div class="duration d-flex align-items-center">
										<i class="fa-solid fa-clock ms-2"></i>
										@if(app()->getLocale() === 'ar')
											{{$private_tour->package->packageTitle->title_ar}}
										@elseif(app()->getLocale() === 'ru')
											{{$private_tour->package->packageTitle->title_ru}}
										@else
											{{$private_tour->package->packageTitle->title_en}}
										@endif
									</div>
									<div class="persons d-flex align-items-center">
										<i class="fa-solid fa-user ms-2"></i>
										@if ($private_tour->number_of_people)
												{{$private_tour->number_of_people}}
										@else
												2
										@endif
									</div>
								</div>
								
							</div>
							
							

							<div class="upper-content">
								<div class="text-content">
									<h3 class="{{ app()->getLocale() === 'ar' ? 'text-end' : 'text-start' }}">
										@lang('common.Package Details')
									</h3>
									
									<p>
										@if(app()->getLocale() === 'ar')
											{!!$private_tour->package->description_ar!!}
										@elseif(app()->getLocale() === 'ru')
											{!!$private_tour->package->description_ru!!}
										@else
											{!!$private_tour->package->description_en!!}
										@endif
										
									</p>
								</div>
								<div class="basic-info">
									<div class="i-block clearfix">
										<h5 class="{{ app()->getLocale() === 'ar' ? 'text-end' : 'text-start' }}">
											@lang('common.Basic Information')
										</h5>
									</div>
									<div class="i-block clearfix d-flex align-items-start 
										{{ app()->getLocale() === 'ar' ? 'flex-row-reverse text-end' : 'text-start' }}">
										<div class="i-title fw-bold">
											@lang('common.Destination')
										</div>
										<div class="i-content">
											@if(app()->getLocale() === 'ar')
												{{$private_tour->package->destination->name_ar}}
											@elseif(app()->getLocale() === 'ru')
												{{$private_tour->package->destination->name_ru}}
											@else
												{{$private_tour->package->destination->name_en}}
											@endif
										</div>
									</div>

									
									<div class="i-block clearfix d-flex align-items-start 
										{{ app()->getLocale() === 'ar' ? 'flex-row-reverse text-end' : 'text-start' }}">
										<div class="i-title">@lang('common.From')</div>
										<div class="i-content">{{$private_tour->from}}</div>
									</div>
									<div class="i-block clearfix d-flex align-items-start 
										{{ app()->getLocale() === 'ar' ? 'flex-row-reverse text-end' : 'text-start' }}">
										<div class="i-title">@lang('common.Till') </div>
										<div class="i-content">{{$private_tour->till}}</div>
									</div>
									
									{{-- Include --}}
									@if (count($package_amenities_includes) > 0)
										<div class="i-block clearfix d-flex align-items-start 
											{{ app()->getLocale() === 'ar' ? 'flex-row-reverse text-end' : 'text-start' }}">
											<div class="i-title fw-bold ">@lang('common.Included')</div>
											<div class="i-content">
												<ul class=" list-unstyled m-0  ">
													@foreach ($package_amenities_includes as $item)
														<li class="d-flex align-items-center {{ app()->getLocale() === 'ar' ? 'flex-row-reverse text-end' : 'text-start' }}"> 
															<i class="fa fa-check-circle {{ app()->getLocale() === 'ar' ? 'ms-2' : ' me-2' }} "></i>
															<span>
																@if(app()->getLocale() === 'ar')
																	{{ $item->amenity->name_ar }}
																@elseif(app()->getLocale() === 'ru')
																	{{ $item->amenity->name_ru }}
																@else
																	{{ $item->amenity->name_en }}
																@endif
															</span>
														</li>
													@endforeach
												</ul>
											</div>
										</div>
										
									@endif
									
									{{-- Not Included --}}
									@if (count($package_amenities_excludes) > 0)
										<div class="i-block clearfix d-flex align-items-start 
											{{ app()->getLocale() === 'ar' ? 'flex-row-reverse text-end' : 'text-start' }}">
											<div class="i-title fw-bold">@lang('common.Not Included')</div>
											<div class="i-content">
												<ul class="list-unstyled m-0">
													@foreach ($package_amenities_excludes as $item)
														<li class="d-flex align-items-center 
															{{ app()->getLocale() === 'ar' ? 'flex-row-reverse text-end' : 'text-start' }}">
															<!-- Changed icon for 'Not Included' -->
															<i class="fa fa-times-circle {{ app()->getLocale() === 'ar' ? 'ms-2' : 'me-2' }}"></i>
															<span>
																@if(app()->getLocale() === 'ar')
																	{{ $item->amenity->name_ar }}
																@elseif(app()->getLocale() === 'ru')
																	{{ $item->amenity->name_ru }}
																@else
																	{{ $item->amenity->name_en }}
																@endif
																
															</span>
														</li>
													@endforeach
												</ul>
											</div>
										</div>
									@endif

								</div>
							</div>

                            {{-- Package itinerary --}}
							<div class="t-plans">
								<h3 class="{{ app()->getLocale() === 'ar' ? 'text-end' : 'text-start' }}">
									@lang('common.Tour Plans')
								</h3>
								<ul class="accordion-box tp-accordion clearfix">
									<!--Block-->
                                    @foreach ($private_tour_details as $item)
                                        <li class="accordion block">
                                            <div class="acc-btn active">
                                                <span class="d-count">Day {{ $loop->iteration }}</span>
												@if(app()->getLocale() === 'ar')
													{{$item->dayTour->title_ar}}
												@elseif(app()->getLocale() === 'ru')
													{{$item->dayTour->title_ru}}
												@else
													{{$item->dayTour->title_en}}
												@endif
												 
                                                <span class="arrow fa fa-angle-down"></span>
                                            </div>
                                            <div class="acc-content current">
                                                <div class="content">
                                                    <div class="travilo-text">
                                                        <!-- Unique carousel ID -->
                                                        <div class="mb-2">
															<div id="carouselExampleInterval{{ $loop->iteration }}" class="carousel slide" data-bs-ride="carousel">
																<div class="carousel-inner">
																	@foreach ($item->dayTour->tour_photos as $photo)
																		<div class="carousel-item {{ $loop->first ? 'active' : '' }}" data-bs-interval="10000">
																			<img src="{{ asset('uploads/'.$photo->photo) }}" class="d-block w-100" alt="...">
																		</div>
																	@endforeach
																</div>
																<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval{{ $loop->iteration }}" data-bs-slide="prev">
																	<span class="carousel-control-prev-icon" aria-hidden="true"></span>
																	<span class="visually-hidden">Previous</span>
																</button>
																<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval{{ $loop->iteration }}" data-bs-slide="next">
																	<span class="carousel-control-next-icon" aria-hidden="true"></span>
																	<span class="visually-hidden">Next</span>
																</button>
															</div>
														</div>
														
														<p class="{{ app()->getLocale() === 'ar' ? 'text-end' : 'text-start' }}">
															@if(app()->getLocale() === 'ar')
																{!! $item->dayTour->description_ar !!}
															@elseif(app()->getLocale() === 'ru')
																{!! $item->dayTour->description_ru !!}
															@else
																{!! $item->dayTour->description_en !!}
															@endif
														</p>
                                                        @if ($item->with_accommodation)
                                                            <table class="table align-middle table-sm">
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="text-center" style="width: 30px;">
                                                                            <i class="fa-solid fa-hotel fa-sm"></i>
                                                                        </td>
                                                                        <td class="text-start">{{$item->accommodation->name}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-center" style="width: 30px;">
                                                                            <i class="fa-solid fa-house fa-sm"></i>
                                                                        </td>
                                                                        <td class="text-start">{{$item->accommodation->accommodation_type}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-center" style="width: 30px;">
                                                                            <i class="fa-solid fa-star fa-sm"></i>
                                                                        </td>
                                                                        <td class="text-start">{{$item->accommodation->rate}} Star</td>
                                                                    </tr>
                                                                    <tr class="no-border">
                                                                        <td class="text-center" style="width: 30px;">
                                                                            <i class="fa-solid fa-location-dot fa-sm"></i>
                                                                        </td>
                                                                        <td class="text-start">{{$item->accommodation->city->city_en}}</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach

									
								</ul>
							</div>

                            {{-- package Location --}}
							@if (!empty($private_tour->package->destination->map))
								<div class="location">
									<h3 class="{{ app()->getLocale() === 'ar' ? 'text-end' : 'text-start' }}">
										@lang('common.Map')
									</h3>
									<div class="map-box">
										<iframe
											src="{{ $private_tour->package->destination->map }}"
											allowfullscreen="" loading="lazy"
											referrerpolicy="no-referrer-when-downgrade"></iframe>

										<div class="map-icon"><img src="assets/images/icons/map-marker-2.png" alt=""></div>
									</div>
								</div>
							@endif



                            {{-- Package FAQs --}}
                            @if ($package_faqs->count() > 0)
								<div class="t-faqs">
									<h3 class="{{ app()->getLocale() === 'ar' ? 'text-end' : 'text-start' }}">
										@lang('common.Frequently Asked Questions')
									</h3>
									<ul class="accordion-box faqs-accordion clearfix">
										<!--Block-->
										@foreach ($package_faqs as $item)
											<li class="accordion block">
												<div class="acc-btn d-flex align-items-center
													{{ app()->getLocale() === 'ar' ? 'flex-row-reverse' : '' }}">
													
													<!-- Question Text -->
													<span class="{{ app()->getLocale() === 'ar' ? 'me-2' : 'ms-2' }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" 
														style="text-align: {{ app()->getLocale() === 'ar' ? 'right' : 'left' }};">
														@if(app()->getLocale() === 'ar')
															{{$item->question_ar}}
														@elseif(app()->getLocale() === 'ru')
															{{$item->question_ru}}
														@else
															{{$item->question_en}}
														@endif
													</span>
													
													<!-- Arrow Icon (Reversed in Arabic) -->
													<span class="arrow fa fa-plus {{ app()->getLocale() === 'ar' ? 'ms-2' : 'me-2' }}"></span>
												</div>
												<div class="acc-content">
													<div class="content">
														<div class="travilo-text">
															<p dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" 
																style="text-align: {{ app()->getLocale() === 'ar' ? 'right' : 'left' }};">
																 @if(app()->getLocale() === 'ar')
																	 {{$item->answer_ar}}
																 @elseif(app()->getLocale() === 'ru')
																	 {{$item->answer_ru}}
																 @else
																	 {{$item->answer_en}}
																 @endif
															 </p>
														</div>
													</div>
												</div>
											</li>
										@endforeach
									</ul>
								</div>
							@endif

							

							{{-- Photo Gallery --}}
							@if (count($package_photos) > 0)
								<div class="t-gallery">
									<h3 class="{{ app()->getLocale() === 'ar' ? 'text-end' : 'text-start' }}">
										@lang('common.Photo Gallery')
									</h3>
									<div class="row g-3 d-flex align-items-start 
											{{ app()->getLocale() === 'ar' ? 'flex-row-reverse text-end' : 'text-start' }}"> <!-- Bootstrap grid with gap -->
										@foreach ($package_photos as $item)
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
							@if (count($package_videos) > 0)
								<div class="t-gallery">
									<h3 class="{{ app()->getLocale() === 'ar' ? 'text-end' : 'text-start' }}">
										@lang('common.Video Gallery')
									</h3>
									<div class="row d-flex align-items-start 
											{{ app()->getLocale() === 'ar' ? 'flex-row-reverse text-end' : 'text-start' }}">
										@foreach ($package_videos as $item)
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

							{{-- Reviews --}}
							<div class="t-reviews">
									@if (count($package_reviews) > 0)
									<h3 class="{{ app()->getLocale() === 'ar' ? 'text-end' : 'text-start' }}">
										@lang('common.Reviews')
									</h3>
									<div class="reviews">
										@foreach ($package_reviews as $item)
											<div class="rev-box">
												<div class="inner">
													<div class="rev-header clearfix">
														<h4>{{$private_tour->package->packageTitle->title_en}}</h4>
														<div class="rating">
															@for ($i = 1; $i <= 5; $i++)
																@if ($i<= $item->rating)
																	<i class="fa-solid fa-star"></i>
																@endif
														 	@endfor
															
														</div>
													</div>
													<p class="travilo-text"> {!!$item->comment!!}</p>
													<div class="lower clearfix">
														<div class="author-info">
															<div class="image">
																@if ($item->user->photo == '')
																	<img src="{{asset('uploads/default.png')}}" alt=""> 
																@else
																	<img src="{{asset('uploads/'.$item->user->photo)}}" alt=""> 
																@endif
															</div>
															<div class="author-name">{{$item->user->name}}</div>
															@if ($item->user->country)
																<div class="designation">{{$item->user->country}}</div>
															@endif
															
														</div>
														<div class="ld-link">
															<span class="txt">{{ $item->created_at->format('F j, Y') }}</span>															
														</div>
													</div>
												</div>
											</div>
										@endforeach
										<div class="styled-pagination centered">
											<ul class="clearfix">
												@foreach ($package_reviews->getUrlRange(1, $package_reviews->lastPage()) as $page => $url)
													<li class="{{ $page == $package_reviews->currentPage() ? 'active' : '' }}">
														<a href="{{ $url }}">{{ $page }}</a>
													</li>
												@endforeach
										
												@if ($package_reviews->hasMorePages())
													<li><a href="{{ $package_reviews->nextPageUrl() }}"><i class="fa-solid fa-angle-right"></i></a></li>
												@else
													<li><a href="#"><i class="fa-solid fa-angle-right"></i></a></li>
												@endif
											</ul>
										</div>
										

									</div>
									@endif

									
									@if (Auth::guard('web')->check())
										@php
											$review_possible=App\Models\PrivateTour::where('package_id',$package->id)
												->where('user_id',Auth::guard('web')->user()->id)
												->where('reserved',true)
												->count();
										@endphp

										@if ($review_possible > 0)
											@php
												App\Models\Review::where('package_id',$package->id)
												->where('user_id',Auth::guard('web')->user()->id)->count() > 0 ?
												$reviewed = true : $reviewed = false ;
											@endphp
											
											@if ($reviewed == false)
												<h3>Add A Review</h3>
												<form action="{{route('review_submit')}}" method="post">
													@csrf
													<input type="hidden" name="package_id" value="{{$package->id}}" />
													<div class="row clearfix">
														<div class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12">
															<div class="s-rev-option">
																<span class="ser-ttl">Rate Your Tour</span>
																<div class="give-review-auto-select">
	
																	<!-- 1 Star Rating -->
																	<input type="radio" class="btn-check" name="rating" id="star1" value="1" autocomplete="off" />
																	<label for="star1" title="1 star"><i class="fas fa-star"></i></label>
	
																	<!-- 2 Star Rating -->
																	<input type="radio" class="btn-check" name="rating" id="star2" value="2" autocomplete="off" />
																	<label for="star2" title="2 stars"><i class="fas fa-star"></i></label>
	
																	<!-- 3 Star Rating -->
																	<input type="radio" class="btn-check" name="rating" id="star3" value="3" autocomplete="off" />
																	<label for="star3" title="3 stars"><i class="fas fa-star"></i></label>
	
																	<!-- 4 Star Rating -->
																	<input type="radio" class="btn-check" name="rating" id="star4" value="4" autocomplete="off" />
																	<label for="star4" title="4 stars"><i class="fas fa-star"></i></label>
	
																	<!-- 5 Star Rating -->
																	<input type="radio" class="btn-check" name="rating" id="star5" value="5" autocomplete="off" />
																	<label for="star5" title="5 stars"><i class="fas fa-star"></i></label>
															
																</div>
															</div>
															
															
															
															<script>
																document.addEventListener('DOMContentLoaded', function () {
																	const labels = document.querySelectorAll('.give-review-auto-select label');
	
																	labels.forEach((label, index) => {
																		label.addEventListener('mouseover', () => {
																			labels.forEach((s, i) => {
																				if (i <= index) {
																					s.style.color = '#f5b301'; // Highlight from left to right
																				} else {
																					s.style.color = '#ccc'; // Reset others
																				}
																			});
																		});
	
																		label.addEventListener('mouseout', () => {
																			labels.forEach((s) => {
																				const selectedRating = document.querySelector('.give-review-auto-select input[type="radio"]:checked');
																				if (selectedRating) {
																					const selectedValue = selectedRating.value;
																					if (parseInt(s.getAttribute('for').replace('star', '')) <= selectedValue) {
																						s.style.color = '#f5b301'; // Keep highlighted if selected
																					} else {
																						s.style.color = '#ccc'; // Reset others
																					}
																				} else {
																					s.style.color = '#ccc'; // Reset to default color
																				}
																			});
																		});
																	});
																});
	
															</script>
															
															
														</div>
													
														<div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12">
															<div class="field-inner">
																<textarea name="comment"
																	placeholder="Start writing your review here"
																	required>
																</textarea>
															</div>
														</div>
														<div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12">
															<button type="submit" class="theme-btn btn-style-one"><span>Submit
																	Review</span></button>
														</div>
													</div>
												</form>
											
											@endif
										@else
											<div class="alert alert-danger">
												You have to Book this Package to Review
											</div>

										@endif
                                @else
									<div class="link ">
										<a href="#" class="theme-btn btn-style-one mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">
											<span>Login to add a Review</span>
										</a>
									</div>
                                @endif

								</div>
							


							</div>
					</div>

					<!--Sidebar Side-->
					<div class="sidebar-side col-xl-4 col-lg-8 col-md-12 col-sm-12">
						<div class="sidebar-inner">
							<!--Widget-->
							<div class="dsp-widget t-book-widget alt-margin">
								<div class="inner-box">
									<div class="t-book-header">
										<span class="st-txt">Total <br>Price</span>
										<span class="amount">${{$private_tour->total_price}}</span>
										<span class="qty">/ Per 
											@if ($private_tour->number_of_people)
												{{$private_tour->number_of_people}}
											@else
												2
											@endif
											 Person</span>
									</div>
									{{-- <div class="lower-box">
										<div class="form-box site-form">
											<form method="post" action="tour-single.html">
												<div class="fields">
													<div class="form-group">
														<div class="field-label">Date</div>
														<div class="field-inner">
															<input class="datepicker" type="text" name="field-name"
																value="" placeholder="Select a date" required>
															<i class="alt-icon fa fa-calendar-alt"></i>
														</div>
													</div>
													<div class="form-group">
														<div class="field-label">Time</div>
														<div class="field-inner">
															<select name="field-name" class="custom-select">
																<option>Select a time</option>
																<option>0000 Hrs</option>
																<option>0200 Hrs</option>
																<option>0400 Hrs</option>
																<option>0600 Hrs</option>
																<option>0800 Hrs</option>
																<option>1000 Hrs</option>
																<option>1200 Hrs</option>
																<option>1400 Hrs</option>
																<option>1600 Hrs</option>
																<option>1800 Hrs</option>
																<option>2000 Hrs</option>
																<option>2200 Hrs</option>
															</select>
														</div>
													</div>
												</div>
												<h6>Tickets</h6>
												<div class="tickets">
													<div class="ticket-block clearfix">
														<div class="tick-ttl">Adults (18+ years)</div>
														<div class="tick-sel">
															<div class="quantity-box">
																<div class="item-quantity">
																	<input class="qty-spinner" type="text" value="1"
																		name="quantity">
																</div>
															</div>
														</div>
													</div>
													<div class="ticket-block clearfix">
														<div class="tick-ttl">Kids (12+ years)</div>
														<div class="tick-sel">
															<div class="quantity-box">
																<div class="item-quantity">
																	<input class="qty-spinner" type="text" value="1"
																		name="quantity">
																</div>
															</div>
														</div>
													</div>
													<div class="ticket-block clearfix">
														<div class="tick-ttl">Children (3+ years)</div>
														<div class="tick-sel">
															<div class="quantity-box">
																<div class="item-quantity">
																	<input class="qty-spinner" type="text" value="1"
																		name="quantity">
																</div>
															</div>
														</div>
													</div>
												</div>
												<h6>Additional Service</h6>
												<div class="add-ser">
													<ul>
														<li>
															<div class="cb-block"><input type="checkbox" id="cb-1">
																<label class="clearfix" for="cb-1"><span
																		class="txt">Additional Guide</span><span
																		class="amount">$50</span></label></div>
														</li>
														<li>
															<div class="cb-block"><input type="checkbox" id="cb-2">
																<label class="clearfix" for="cb-2"><span
																		class="txt">Internet</span><span
																		class="amount">$30</span></label>
															</div>
														</li>
														<li>
															<div class="cb-block"><input type="checkbox" id="cb-3">
																<label class="clearfix" for="cb-3"><span
																		class="txt">Photography</span><span
																		class="amount">$90</span></label>
															</div>
														</li>
													</ul>
												</div>
												<div class="total clearfix">
													<div class="t-ttl">Total</div>
													<div class="ttl-amt">$450</div>
												</div>
												<div class="proceed-link"><button type="button"
														class="theme-btn btn-style-two"><span>Proceed to
															Book</span></button></div>
											</form>
										</div>
									</div> --}}
								</div>
							</div>

							<!--Widget-->
							<div class="dsp-widget get-help-widget">
								<div class="inner">
									<h6 class="{{ app()->getLocale() === 'ar' ? 'text-end' : 'text-start' }}">
										@lang('common.Get Help')
									</h6>
									<h3 class="{{ app()->getLocale() === 'ar' ? 'text-end' : 'text-start' }}">
										@lang('common.Need Help to Book?')
									</h3>
									<p class="travilo-text {{ app()->getLocale() === 'ar' ? 'text-end' : 'text-start' }}">
										@lang('common.Our dedicated team of travel experts is here to assist you every step of the way, ensuring a seamless and unforgettable journey.')
									</p>
									<div class="call-to">
										<a href="tel:{{$cooperator->phone}}"><i class="icon fa-solid fa-phone"></i> Call Us 
											<span class="nmbr">{{$cooperator->phone}}</span></a>
									</div>
								</div>
							</div>

							<!--Widget-->
							{{-- <div class="dsp-widget similar-widget">
								<div class="inner">
									<h3>You might also like</h3>
									<!--Logo-->
									<div class="posts">
										<div class="post">
											<div class="image"><a href="#"><img
														src="assets/images/resources/thumbnails/uk-thumb.jpg"
														alt="London Bridge"></a>
											</div>
											<h6><a href="#">Iconic Landmark Connecting History and Modernity</a></h6>
											<div class="price">Starts from <span class="amount">$399</span></div>
										</div>
										<div class="post">
											<div class="image"><a href="#"><img
														src="assets/images/resources/thumbnails/maldives-thumb.jpg"
														alt="Maldives"></a></div>
											<h6><a href="#">Unveiling the Serenity of Maldivian Islands</a></h6>
											<div class="price">Starts from <span class="amount">$595</span></div>
										</div>
										<div class="post">
											<div class="image"><a href="#"><img
														src="assets/images/resources/thumbnails/finland-thumb.jpg"
														alt="Helsinki"></a></div>
											<h6><a href="#">Vibrant Helsinki, A Fusion of Culture and Cuisine</a></h6>
											<div class="price">Starts from <span class="amount">$565</span></div>
										</div>
									</div>
								</div>
							</div> --}}

						</div>
					</div>

				</div>
			</div>
		</div>






@endsection