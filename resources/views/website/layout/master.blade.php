@php
    $setting=App\Models\Setting::where('id',1)->first();
@endphp
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
	<meta charset="utf-8">
	<!-- Responsive -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<meta property="og:title" content="{{$cooperator->agent_name}}">
	<meta property="og:description" content="+{{$cooperator->phone}}">
	<meta property="og:image" content="{{ asset('uploads/'.$cooperator->logo) }}">
	<meta property="og:url" content="{{ url()->current() }}">
	<meta property="og:type" content="website">

	<title>{{$cooperator->agent_name}}</title>

	<link href="{{asset('uploads/'.$cooperator->logo)}}" rel="shortcut icon" type="image/x-icon">

	<!-- Google Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Noto+Sans+Arabic:wght@100..900&display=swap" rel="stylesheet">
	

	<!-- Stylesheets -->
    <link href="{{ asset('assets/css/lib/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/lib/fontawesome/css/fontawesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/lib/fontawesome/css/brands.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/lib/fontawesome/css/solid.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/lib/simple-line-icons/css/simple-line-icons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/lib/flaticon/css/flaticon.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/lib/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/lib/slick.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/lib/swiper.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/lib/jquery-ui.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/lib/jquery.fancybox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/custom-animate.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet">
	{{-- https://flagicons.lipis.dev/ --}}
	<link href="{{ asset('flag-icons-main/css/flag-icons.min.css') }}" rel="stylesheet">



	


</head>

<body>
	<div class="page-wrapper">

		<!-- Preloader -->
		<div class="loader-wrap">
			<div class="preloader">
				<div class="preloader-close">x</div>
				<div id="handle-preloader" class="handle-preloader">
					<div class="animation-preloader">
						<div class="txt-loading">
							<span data-text-preloader="T" class="letters-loading">T</span>
							<span data-text-preloader="U" class="letters-loading">U</span>
							<span data-text-preloader="R" class="letters-loading">R</span>
							<span data-text-preloader="I" class="letters-loading">I</span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Preloader End -->

		<!-- Main Header-->
		<header class="main-header header-style-two">
			<div class="header-top">
				<div class="auto-container">
					<div class="inner clearfix">
						<div class="top-left clearfix">
							<ul class="info clearfix">
								<li><i class="icon fa fa-envelope"></i> <a
										href="mailto:hello@travilo.com">{{$cooperator->email}}</a></li>
								<li><i class="icon fa fa-map-marker-alt"></i> <a href="#">{{$cooperator->address}}</a></li>
							</ul>
						</div>
						<div class="top-right clearfix">
							<div class="login">
								@if (Auth::guard('web')->check())
								
								<div class="lang-box">
									<div class="lang-btn clearfix">
										<!-- User profile image with inline style -->
										<span class="txt">
											{{-- <img src="{{ Auth::user()->photo ? asset('uploads/' . Auth::user()->photo) : asset('uploads/default.png') }}" 
											alt="User Profile" 
											style="width: 30px; height: 30px; border-radius: 50%; object-fit: cover; margin-right: 10px;">
										 --}}
											Dashboard
										</span><span class="icon far fa-angle-down"></span>
										
									</div>
									<ul class="lang-list">
										<li><a href="{{route('logout')}}">Logout</a></li>
									</ul>
								</div>
							@else
								<a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">
									Login
								</a>
							@endif

								
							</div>
							<div class="lang-box">
								<div class="lang-btn clearfix">
									<span class="txt">{{ strtoupper(app()->getLocale()) }}</span>
									<span class="icon far fa-angle-down"></span>
								</div>
								<ul class="lang-list">
									@php
										$currentRoute = Route::currentRouteName();
										$routeParams = array_merge(request()->route()->parameters(), ['lang' => null]);
									@endphp
									<li><a href="{{ route($currentRoute, array_merge($routeParams, ['lang' => 'en'])) }}">English</a></li>
									<li><a href="{{ route($currentRoute, array_merge($routeParams, ['lang' => 'ru'])) }}">Russian</a></li>
									<li><a href="{{ route($currentRoute, array_merge($routeParams, ['lang' => 'ar'])) }}">Arabic</a></li>
								</ul>
							</div>
							<div class="social">
							
								<ul class="social-links clearfix">
										@if (!empty($cooperator->facebook))
											<li>
												<a href="{{$cooperator->facebook}}" class="facebook" target="_blank" rel="noopener noreferrer">
													<i class="fab fa-facebook-f"></i>
												</a>
											</li>
										@endif
									
										@if (!empty($cooperator->twitter))
											<li>
												<a href="{{$cooperator->twitter}}" class="twitter" target="_blank" rel="noopener noreferrer">
													<i class="fab fa-twitter"></i>
												</a>
											</li>
										@endif
									
										@if (!empty($cooperator->linkedin))
											<li>
												<a href="{{$cooperator->linkedin}}" class="linkedin" target="_blank" rel="noopener noreferrer">
													<i class="fab fa-linkedin-in"></i>
												</a>
											</li>
										@endif
									
										@if (!empty($cooperator->youtube))
											<li>
												<a href="{{$cooperator->youtube}}" class="youtube" target="_blank" rel="noopener noreferrer">
													<i class="fab fa-youtube"></i>
												</a>
											</li>
										@endif
									
										@if (!empty($cooperator->instagram))
											<li>
												<a href="{{$cooperator->instagram}}" class="youtube" target="_blank" rel="noopener noreferrer">
													<i class="fab fa-instagram"></i>
												</a>
											</li>
										@endif
									</ul>
							
									
								
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Header Upper -->
			<div class="header-upper">
				<div class="auto-container">
					<!-- Main Box -->
					<div class="main-box clearfix">
						<!--Logo-->
						<div class="logo-box">
							<div class="logo"><a href="{{ route('home.lang', ['lang' => request()->segment(1), 'cooperator' => $cooperator->slug]) }}" title="Travilo"><img src="{{asset('uploads/'.$cooperator->logo)}}"
										alt="" title="Travilo"></a></div>
						</div>

						<div class="outer clearfix">
							<div class="nav-box clearfix">
								<!--Nav Outer-->
								<div class="nav-outer clearfix">


									@include('website.layout.nav')
                                    
									
									<!-- Main Menu End-->
								</div>
								<!--Nav Outer End-->

							</div>

							<div class="links-box clearfix">
								<div class="link call-to">
									<a href="tel:{{$cooperator->phone}}"><i class="icon fa-solid fa-phone"></i> Call Us <span
											class="nmbr">{{$cooperator->phone}}</span></a>
								</div>
							</div>

							<!-- Hidden Nav Toggler -->
							<div class="nav-toggler">
                                <div class="d-flex flex-row align-items-center bd-highlight ">
                                    
                                    <div class="lang-box me-4  rounded button-language p-0">
                                        <div class=" btn-sm d-inline-flex align-items-center  p-1">
                                            <span class="me-2">
												@if(app()->getLocale() === 'ar')
													<i class="fi fi-sa"></i>
												@elseif(app()->getLocale() === 'ru')
													<i class="fi fi-ru"></i>
												@else
													<i class="fi fi-us"></i>
												@endif
                                            </span>
                                            <span class="icon far fa-angle-down"></span>
                                        </div>
                                        
                                        <ul class="lang-list">
											<li><a href="{{ route($currentRoute, array_merge($routeParams, ['lang' => 'en'])) }}">English</a></li>
											<li><a href="{{ route($currentRoute, array_merge($routeParams, ['lang' => 'ru'])) }}">Russian</a></li>
											<li><a href="{{ route($currentRoute, array_merge($routeParams, ['lang' => 'ar'])) }}">Arabic</a></li>
                                        </ul>
                                    </div>
                                    
                                    <button class="hidden-bar-opener ">
                                        <span class="icon">
                                            <img src="{{asset('assets/images/icons/menu-icon.svg')}}" alt="">
                                        </span>
                                    </button>
                                </div>
                               
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- End Header Upper -->
		</header>
		<!--End Main Header -->


		<!--Menu Backdrop-->
		<div class="menu-backdrop"></div>

		<!-- Hidden Navigation Bar -->
		<div class="hidden-bar">
			<!-- Hidden Bar Wrapper -->
			<div class="hidden-bar-wrapper">
				<div class="hidden-bar-closer">
					<span class="icon"><svg class="icon-close" role="presentation"
							viewBox="0 0 16 14">
							<path d="M15 0L1 14m14 0L1 0" stroke="currentColor" fill="none" fill-rule="evenodd"></path>
						</svg>
					</span>
				</div>
				<div class="nav-logo-box">
					<!-- logo will be copied here ! -->
				</div>
				<!-- .Side-menu -->
				<nav class="side-menu">
					<!-- main-menu will be copied here! -->
				</nav><!-- .side-menu -->
				@if (Auth::guard('web')->check())
					<div class="links-box clearfix">
						<div class="">
							<a href="{{route('logout')}}">Logout</a>
						</div>
					</div>				
				@else
					<div class="links-box clearfix">
						<div class="clearfix">
							<div class="link hidden-bar-closer">
								<a href="#" class="theme-btn btn-style-one" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">
									<span>Login</span>
								</a>
							</div>
						</div>
					</div>				
				@endif
				
				

			</div><!-- / Hidden Bar Wrapper -->
		</div>
		<!-- / Hidden Bar -->

        @yield('main_content')

		
		

		<!--Main Footer-->
        <footer class="main-footer style-two">
            <div class="auto-container">
                <div class="content-box">
                    <div class="row row-cols-1 row-cols-lg-4 justify-content-md-center p-3">
                        <!-- Column 1 -->
                        <div class="col-12 col-lg-3 d-flex justify-content-center align-items-center mb-3 mb-lg-0">
                            <img src="{{asset('uploads/'.$cooperator->logo)}}" alt="" title="Travilo" style="height: 50px">
                        </div>
        
                        <!-- Column 2 -->
                        <div class="col-12 col-lg-3 d-flex justify-content-center align-items-center mb-3 mb-lg-0">
                            <ul class="info">
                                <li class="address">
                                    <a href="#"><i class="icon fa fa-map-marker-alt"></i>
                                        {{$cooperator->address}}
                                    </a>
                                </li>
                            </ul>
                        </div>
        
                        <!-- Column 3 -->
                        <div class="col-12 col-lg-3 d-flex justify-content-center align-items-center mb-3 mb-lg-0">
                            <ul class="info">
                                <li class="email">
                                    <a href="mailto:{{$cooperator->email}}">
                                        <i class="icon fa fa-envelope"></i>
                                        {{$cooperator->email}}
                                    </a>
                                </li>
                            </ul>
                        </div>
        
                        <!-- Column 4 -->
                        <div class="col-12 col-lg-3 d-flex justify-content-center align-items-center mb-3 mb-lg-0">
                            <ul class="social-links d-flex align-items-center p-0">
								@if (!empty($cooperator->facebook))
								<li>
									<a href="{{$cooperator->facebook}}" class="facebook" target="_blank" rel="noopener noreferrer">
										<i class="fab fa-facebook-f"></i>
									</a>
								</li>
								@endif
							
								@if (!empty($cooperator->twitter))
									<li>
										<a href="{{$cooperator->twitter}}" class="twitter" target="_blank" rel="noopener noreferrer">
											<i class="fab fa-twitter"></i>
										</a>
									</li>
								@endif
							
								@if (!empty($cooperator->linkedin))
									<li>
										<a href="{{$cooperator->linkedin}}" class="linkedin" target="_blank" rel="noopener noreferrer">
											<i class="fab fa-linkedin-in"></i>
										</a>
									</li>
								@endif
							
								@if (!empty($cooperator->youtube))
									<li>
										<a href="{{$cooperator->youtube}}" class="youtube" target="_blank" rel="noopener noreferrer">
											<i class="fab fa-youtube"></i>
										</a>
									</li>
								@endif
							
								@if (!empty($cooperator->instagram))
									<li>
										<a href="{{$cooperator->instagram}}" class="youtube" target="_blank" rel="noopener noreferrer">
											<i class="fab fa-instagram"></i>
										</a>
									</li>
								@endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        

	</div>
	<!--End pagewrapper-->

	<!--Scroll to top-->
	<div class="scroll-to-top scroll-to-target" data-target="html">
		<span class="icon"><img src="{{asset('assets/images/icons/arrow-up.svg')}}" alt="" title="Go To Top"></span>
	</div>

	{{-- Login Modal --}}
	<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5" id="exampleModalLabel">Login</h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form action="{{route('login_submit')}}" method="post">	
					@csrf
					<div class="modal-body">
							<div class="form-group form-group-sm">
								<div class="field-inner mb-3">
									<label for="email" class="col-form-label">Email:</label>
									<input type="email" id="email" name="email" placeholder="Enter your email" class="form-control" required>
								</div>
							</div>
		
							<div class="form-group form-group-sm">
								<div class="field-inner mb-3">
									<label for="password" class="col-form-label">Password:</label>
									<input type="password" id="password" name="password" placeholder="Enter your password" class="form-control" required>
								</div>
							</div>
								
					</div>
					<div class="modal-footer d-flex justify-content-between align-items-center">
						<!-- Forget Password Link -->
						<a href="{{route('forget_password')}}" class="">Forget Password?</a>
						<!-- Login Button -->
						<button type="submit" class="theme-btn btn-style-one">
							<span>Login</span>
						</button>
					</div>
				</form>	
			</div>
		</div>
	</div>
	



	<script src="{{ asset('assets/js/lib/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/jquery.fancybox.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/isotope.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/slick.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/appear.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/wow.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/touchspin.min.js') }}"></script>
	<script src="{{ asset('assets/js/lib/swiper.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom-script.js') }}"></script>
	

	
	

</body>

</html>