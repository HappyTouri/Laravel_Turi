
@extends('website.layout.master')

@section('main_content')


		<!-- Banner Section -->
		<section class="inner-banner">
			<div class="image-layer" style="background-image: url({{asset('uploads/'.$packages_banner)}});">
			</div>
			<div class="auto-container">
				<div class="content-box">
					<h1>@lang('common.Tour Packages')</h1>
					<div class="bread-crumb">
						<ul class="clearfix">
							<li><a href="{{ route('home.lang', ['lang' => request()->segment(1), 'cooperator' => $cooperator->slug]) }}">@lang('common.home')</a></li>
							<li class="current">@lang('common.Tour Packages')</li>
						</ul>
					</div>
				</div>
			</div>
		</section>
		<!--End Banner Section -->

		<!--Packages Section-->
		<section class="packages-three">
			<!--Serach One-->
			<div class="search-one">
				<div class="auto-container">
					<div class="outer">
						<div class="search-title"><span>@lang('common.Search for your desired tour package')</span></div>
						<div class="form-box site-form">
							<form action="{{ route('packages', ['lang' => request()->segment(1), 'cooperator' => request()->segment(2)]) }}" method="get">
								<div class="row clearfix">
									<div class="form-group col-xl-3 col-lg-6 col-md-6 col-sm-12">
										<div class="form-group">
											<div class="field-label">@lang('common.destinations')</div>
											<div class="field-inner">
												<select name="destination" class="custom-select">
													<option value="">@lang('common.destinations')</option>
													@foreach ($destinations as $item)
														<option value="{{ $item->id }}"
															{{ request('destination') == $item->id ? 'selected' : '' }}>
															@if(app()->getLocale() === 'ar')
																{{ $item->name_ar }}
															@elseif(app()->getLocale() === 'ru')
																{{ $item->name_ru }}
															@else
																{{ $item->name_en }}
															@endif
														</option>
													@endforeach
												</select>
											</div>
										</div>
									</div>
									<div class="form-group col-xl-3 col-lg-6 col-md-6 col-sm-12">
										<div class="form-group">
											<div class="field-label">@lang('common.Days')</div>
											<div class="field-inner">
												<select name="no_of_days" class="custom-select">
													<option value="">@lang('common.Days')</option>
													@foreach ($days as $item)
														<option value="{{ $item->packageTitle->no_days }}" 
															{{ request()->get('no_of_days') == $item->packageTitle->no_days ? 'selected' : '' }}>
															{{ $item->packageTitle->no_days }}
														</option>
													@endforeach
												</select>
											</div>
										</div>
									</div>
									<div class="form-group col-xl-3 col-lg-6 col-md-6 col-sm-12">
										<div class="form-group">
											<div class="field-label">@lang('common.Rating')</div>
											<div class="field-inner">
												<select name="review" class="custom-select">
													<option value="">@lang('common.Rating')</option>
													<option value="5" {{ request('review') == '5' ? 'selected' : '' }}>5 Star</option>
													<option value="4" {{ request('review') == '4' ? 'selected' : '' }}>4 Star</option>
													<option value="3" {{ request('review') == '3' ? 'selected' : '' }}>3 Star</option>
													<option value="2" {{ request('review') == '2' ? 'selected' : '' }}>2 Star</option>
												</select>
											</div>
										</div>
									</div>
									
								</div>
								<button type="submit" class="theme-btn f-btn"><span>Search <i
											class="fa-solid fa-search"></i></span></button>
							</form>

						</div>
					</div>
				</div>
			</div>

			{{-- Packages  --}}
			<div class="auto-container">
				<div class="packages">

					
					<div class="row clearfix" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
						<!-- Loop Through Packages -->
						@foreach ($packages as $item)
							<div class="package-block col-lg-4 col-md-6 col-sm-12">
								<div class="inner-box">
									<!-- Image Section -->
									<div class="image-box">
										<div class="image">
											<a href="{{ route('package', ['lang' => app()->getLocale(), 'cooperator' => request()->segment(2), 'id' => $item->id]) }}">
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
					
					{{-- Pagination  --}}
					<div class="styled-pagination centered">
						<ul class="clearfix">
							<!-- Previous Page Link -->
							@if (!$packages->onFirstPage())
								<li><a href="{{ $packages->previousPageUrl() }}"><i class="fa-solid fa-angle-left"></i></a></li>
							@endif
					
							<!-- Pagination Elements -->
							@foreach ($packages->getUrlRange(1, $packages->lastPage()) as $page => $url)
								@if ($page == $packages->currentPage())
									<li class="active"><a href="#">{{ $page }}</a></li>
								@else
									<li><a href="{{ $url }}">{{ $page }}</a></li>
								@endif
							@endforeach
					
							<!-- Next Page Link -->
							@if ($packages->hasMorePages())
								<li><a href="{{ $packages->nextPageUrl() }}"><i class="fa-solid fa-angle-right"></i></a></li>
							@endif
						</ul>
					</div>
					
				</div>
			</div>
		</section>


@endsection