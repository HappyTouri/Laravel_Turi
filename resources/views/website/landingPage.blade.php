
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

<body class="vh-100 vw-100 overflow-auto d-flex flex-column">
    <a href="https://wa.me/{{$cooperator->phone}}" class="w-100">
        <img src="{{ asset('uploads/'.$cooperator->landing_page) }}" alt="Full Screen Image" class="img-fluid w-100 object-fit-contain">
    </a>
    <!-- Bootstrap 5 JS -->
    <script src="{{ asset('assets/js/lib/bootstrap/bootstrap.bundle.min.js') }}"></script>

    <style>
        .object-fit-contain {
            object-fit: contain;
        }
        body {
            background-color: black; /* Optional: Background color for empty space */
        }
    </style>
</body>



</html>